<style>
/* Bottom Navigation Bar */
.bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: space-around;
    background-color: #333;
    padding: 10px 0;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
    z-index: 1000;
}

.bottom-nav button {
    background: none;
    border: none;
    color: white;
    text-align: center;
    font-size: 0.9em;
    cursor: pointer;
    flex: 1; /* Make buttons take up equal space */
    outline: none;
}

.bottom-nav button span {
    font-size: 1.5em; /* Icon size */
}

.bottom-nav button:hover {
    background-color: #444;
}

.bottom-nav button:active {
    background-color: #555;
}
 






</style>


<div class="bottom-nav">
    <button onclick="window.location.href='affdash.php'">
        <span>🏠</span><br>Dashboard
    </button>
    <button onclick="window.location.href='marketplace.php'">
        <span>🛒</span><br>Market
    </button>
    <button onclick="window.location.href='recentsales.php'">
        <span>📈</span><br>Sales
    </button>
    <button onclick="window.location.href='contest.php'">
        <span>🎯</span><br>Challenge
    </button>
    <button onclick="window.location.href='leaderboard.php'">
        <span>🏆</span><br>Leaderboard
    </button>
    <button onclick="window.location.href='account_settings.php'">
        <span>⚙️</span><br>Edit Profile
    </button>
</div>
