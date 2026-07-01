// assets/js/components/sticky-notes.js — Windows-style sticky notes guestbook

const StickyNotes = (() => {
    const API_URL = "./assets/api/sticky-notes.php";
    const COLLAPSED_KEY = "portfolio-sticky-notes-collapsed";
    const OWNED_KEY = "portfolio-sticky-notes-owned";

    let root = null;
    let listEl = null;
    let formEl = null;
    let authorInput = null;
    let textInput = null;
    let submitBtn = null;
    let statusEl = null;

    function isCollapsed() {
        try {
            const stored = localStorage.getItem(COLLAPSED_KEY);
            if (stored === null) return true;
            return stored === "1";
        } catch {
            return true;
        }
    }

    function setCollapsed(collapsed) {
        if (!root) return;
        root.classList.toggle("sticky-notes--collapsed", collapsed);
        try {
            localStorage.setItem(COLLAPSED_KEY, collapsed ? "1" : "0");
        } catch {
            /* ignore */
        }
        const toggle = root.querySelector(".sticky-notes__collapse");
        if (toggle) {
            toggle.setAttribute("aria-expanded", collapsed ? "false" : "true");
            toggle.setAttribute("aria-label", collapsed ? "Expand sticky notes" : "Minimise sticky notes");
            toggle.textContent = collapsed ? "▸" : "▾";
        }
    }

    function collapse() {
        setCollapsed(true);
    }

    function loadOwnedTokens() {
        try {
            const raw = localStorage.getItem(OWNED_KEY);
            const parsed = raw ? JSON.parse(raw) : {};
            return parsed && typeof parsed === "object" ? parsed : {};
        } catch {
            return {};
        }
    }

    function saveOwnedToken(noteId, deleteToken) {
        if (!noteId || !deleteToken) return;
        const owned = loadOwnedTokens();
        owned[noteId] = deleteToken;
        try {
            localStorage.setItem(OWNED_KEY, JSON.stringify(owned));
        } catch {
            /* ignore */
        }
    }

    function forgetOwnedToken(noteId) {
        const owned = loadOwnedTokens();
        if (!owned[noteId]) return;
        delete owned[noteId];
        try {
            localStorage.setItem(OWNED_KEY, JSON.stringify(owned));
        } catch {
            /* ignore */
        }
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }

    function formatWhen(timestamp) {
        const date = new Date(timestamp * 1000);
        const now = new Date();
        const diffMs = now - date;
        const diffMins = Math.floor(diffMs / 60000);

        if (diffMins < 1) return "Just now";
        if (diffMins < 60) return `${diffMins}m ago`;

        const diffHours = Math.floor(diffMins / 60);
        if (diffHours < 24) return `${diffHours}h ago`;

        const diffDays = Math.floor(diffHours / 24);
        if (diffDays < 7) return `${diffDays}d ago`;

        return date.toLocaleDateString(undefined, {
            day: "numeric",
            month: "short",
        });
    }

    function renderNotes(notes) {
        if (!listEl) return;

        if (!notes.length) {
            listEl.innerHTML =
                '<p class="sticky-notes__empty">No notes yet — be the first to leave one!</p>';
            return;
        }

        const owned = loadOwnedTokens();

        listEl.innerHTML = notes
            .map((note, index) => {
                const tilt = index % 3 === 1 ? " sticky-note-card--tilt-left" : index % 3 === 2 ? " sticky-note-card--tilt-right" : "";
                const deletable = Boolean(note.id && owned[note.id]);
                const deleteBtn = deletable
                    ? `<button type="button" class="sticky-note-card__delete" data-note-id="${escapeHtml(note.id)}" aria-label="Remove your note">×</button>`
                    : "";
                return `
                    <article class="sticky-note-card${tilt}" data-note-id="${escapeHtml(note.id || "")}">
                        <header class="sticky-note-card__meta">
                            <span class="sticky-note-card__author">${escapeHtml(note.author || "Guest")}</span>
                            <span class="sticky-note-card__meta-end">
                                <time class="sticky-note-card__time" datetime="${note.created}">${formatWhen(note.created)}</time>
                                ${deleteBtn}
                            </span>
                        </header>
                        <p class="sticky-note-card__text">${escapeHtml(note.text)}</p>
                    </article>
                `;
            })
            .join("");
    }

    async function deleteNote(noteId, button) {
        const owned = loadOwnedTokens();
        const deleteToken = owned[noteId];
        if (!deleteToken) {
            setStatus("You can only remove notes you posted from this browser.", "error");
            return;
        }

        if (button) button.disabled = true;
        setStatus("Removing…");

        try {
            const res = await fetch(API_URL, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({ id: noteId, deleteToken }),
            });
            const data = await res.json();

            if (!res.ok || !data.ok) {
                throw new Error(data.error || "Could not remove that note.");
            }

            forgetOwnedToken(noteId);
            setStatus("Note removed.", "success");
            await fetchNotes();
            setTimeout(() => setStatus(""), 2000);
        } catch (err) {
            setStatus(err.message || "Could not remove that note.", "error");
        } finally {
            if (button) button.disabled = false;
        }
    }

    function setStatus(message, type = "") {
        if (!statusEl) return;
        statusEl.textContent = message || "";
        statusEl.className = "sticky-notes__status";
        if (type) statusEl.classList.add(`sticky-notes__status--${type}`);
    }

    async function fetchNotes() {
        setStatus("Loading notes…");
        try {
            const res = await fetch(API_URL, { headers: { Accept: "application/json" } });
            const data = await res.json();
            if (!res.ok || !data.ok) {
                throw new Error(data.error || "Could not load notes.");
            }
            renderNotes(data.notes || []);
            setStatus("");
        } catch (err) {
            renderNotes([]);
            setStatus(err.message || "Could not load notes.", "error");
        }
    }

    async function submitNote(event) {
        event.preventDefault();
        if (!textInput || !submitBtn) return;

        const text = textInput.value.trim();
        const author = authorInput ? authorInput.value.trim() : "";

        if (!text) {
            setStatus("Write something on your sticky note first.", "error");
            textInput.focus();
            return;
        }

        submitBtn.disabled = true;
        setStatus("Posting…");

        try {
            const res = await fetch(API_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({ text, author }),
            });
            const data = await res.json();

            if (!res.ok || !data.ok) {
                throw new Error(data.error || "Could not post your note.");
            }

            textInput.value = "";
            if (data.note?.id && data.deleteToken) {
                saveOwnedToken(data.note.id, data.deleteToken);
            }
            setStatus("Note posted — thanks!", "success");
            await fetchNotes();
            setTimeout(() => setStatus(""), 2500);
        } catch (err) {
            setStatus(err.message || "Could not post your note.", "error");
        } finally {
            submitBtn.disabled = false;
        }
    }

    function bindEvents() {
        const collapseBtn = root.querySelector(".sticky-notes__collapse");
        const closeBtn = root.querySelector(".sticky-notes__close");
        const peekBtn = root.querySelector(".sticky-notes__peek");

        const minimise = (event) => {
            event.preventDefault();
            event.stopPropagation();
            setCollapsed(true);
        };

        collapseBtn?.addEventListener("click", minimise);
        collapseBtn?.addEventListener("touchend", minimise);
        closeBtn?.addEventListener("click", minimise);
        closeBtn?.addEventListener("touchend", minimise);

        peekBtn?.addEventListener("click", (event) => {
            event.preventDefault();
            event.stopPropagation();
            setCollapsed(false);
            textInput?.focus();
        });

        formEl?.addEventListener("submit", submitNote);

        listEl?.addEventListener("click", (event) => {
            const btn = event.target.closest(".sticky-note-card__delete");
            if (!btn || !listEl.contains(btn)) return;
            const noteId = btn.getAttribute("data-note-id");
            if (noteId) deleteNote(noteId, btn);
        });

        textInput?.addEventListener("input", () => {
            const len = textInput.value.length;
            const counter = root.querySelector(".sticky-notes__counter");
            if (counter) counter.textContent = `${len}/280`;
        });
    }

    function init() {
        root = document.getElementById("sticky-notes");
        if (!root) return;

        listEl = root.querySelector(".sticky-notes__list");
        formEl = root.querySelector(".sticky-notes__form");
        authorInput = root.querySelector(".sticky-notes__author");
        textInput = root.querySelector(".sticky-notes__text");
        submitBtn = root.querySelector(".sticky-notes__submit");
        statusEl = root.querySelector(".sticky-notes__status");

        setCollapsed(isCollapsed());
        bindEvents();
        fetchNotes();
    }

    return { init, fetchNotes, collapse };
})();
