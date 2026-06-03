/* Old School RuneScape hiscores viewer (Jagex blocks iframe embeds). */

const OsrsHiscores = (() => {
    const DEFAULT_PLAYER = 'IM_KOFI';
    const OFFICIAL_URL = 'https://secure.runescape.com/m=hiscore_oldschool/hiscorepersonal?user1=';

    let pageEl;
    let statusEl;
    let tableBodyEl;
    let playerNameEl;
    let officialLinkEl;
    let currentPlayer = DEFAULT_PLAYER;
    let loadToken = 0;

    function formatNumber(value) {
        if (value == null || value < 0) {
            return '—';
        }
        return Number(value).toLocaleString('en-GB');
    }

    function formatRank(rank) {
        if (rank == null || rank < 0) {
            return '—';
        }
        return formatNumber(rank);
    }

    function formatXp(xp) {
        if (xp == null || xp < 0) {
            return '—';
        }
        return formatNumber(xp);
    }

    function setStatus(message, type) {
        if (!statusEl) return;
        statusEl.textContent = message;
        statusEl.className = 'osrs-hiscores__status';
        if (type) {
            statusEl.classList.add(`osrs-hiscores__status--${type}`);
        }
    }

    function renderSkills(skills) {
        if (!tableBodyEl) return;

        const rows = skills
            .filter((skill) => skill && skill.name !== 'Overall')
            .map((skill) => {
                const level = skill.level ?? 0;
                const xp = skill.xp ?? 0;
                return `<tr>
                    <td>${escapeHtml(skill.name)}</td>
                    <td>${formatRank(skill.rank)}</td>
                    <td>${formatNumber(level)}</td>
                    <td>${formatXp(xp)}</td>
                </tr>`;
            })
            .join('');

        tableBodyEl.innerHTML = rows;
    }

    function renderOverall(skills) {
        const overall = skills.find((skill) => skill && skill.name === 'Overall');
        if (!overall || !playerNameEl) return;

        playerNameEl.textContent = currentPlayer;
        const meta = pageEl?.querySelector('.osrs-hiscores__overall-meta');
        if (meta) {
            meta.innerHTML = `
                <span><strong>Rank</strong> ${formatRank(overall.rank)}</span>
                <span><strong>Total level</strong> ${formatNumber(overall.level)}</span>
                <span><strong>Total XP</strong> ${formatXp(overall.xp)}</span>
            `;
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    async function load(playerName) {
        currentPlayer = (playerName || DEFAULT_PLAYER).trim();
        const token = ++loadToken;

        if (officialLinkEl) {
            officialLinkEl.href = OFFICIAL_URL + encodeURIComponent(currentPlayer);
        }

        setStatus('Loading hiscores…', 'loading');
        if (tableBodyEl) {
            tableBodyEl.innerHTML = '';
        }

        try {
            const response = await fetch(
                `./assets/api/osrs-hiscores.php?player=${encodeURIComponent(currentPlayer)}`
            );
            const data = await response.json();

            if (token !== loadToken) return;

            if (!response.ok || !data.ok) {
                setStatus(data.error || 'Could not load hiscores.', 'error');
                return;
            }

            currentPlayer = data.player || currentPlayer;
            if (officialLinkEl) {
                officialLinkEl.href = OFFICIAL_URL + encodeURIComponent(currentPlayer);
            }

            renderOverall(data.skills);
            renderSkills(data.skills);
            setStatus('', '');
        } catch (err) {
            if (token !== loadToken) return;
            setStatus('Could not load hiscores. Check your connection and try again.', 'error');
        }
    }

    function init() {
        pageEl = document.getElementById('page-osrs-hiscores');
        if (!pageEl) return;

        statusEl = pageEl.querySelector('.osrs-hiscores__status');
        tableBodyEl = pageEl.querySelector('.osrs-hiscores__table tbody');
        playerNameEl = pageEl.querySelector('.osrs-hiscores__player-name');
        officialLinkEl = pageEl.querySelector('.osrs-hiscores__official-link');
    }

    return { init, load, DEFAULT_PLAYER };
})();
