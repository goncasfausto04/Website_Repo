<header>
    <nav>
        <ul class="left">
            <li><a href="homepage" class="<?= $_SERVER['REQUEST_URI'] === '/homepage' ? 'active' : ''; ?>"><i class="fas fa-home"></i></a></li>
        </ul>
        <ul class="right">
            <li><a href="fumblemeter" class="<?= $_SERVER['REQUEST_URI'] === '/fumblemeter' ? 'active' : ''; ?>" id="rocket-league-meter-link">FumbleMeter</a></li>
            <li><a href="casino" class="<?= $_SERVER['REQUEST_URI'] === '/casino' ? 'active' : ''; ?>" id="casino-link">Casino</a></li>
            <li><a href="minecraft" class="<?= $_SERVER['REQUEST_URI'] === '/minecraft' ? 'active' : ''; ?>">Minecraft</a></li>
            <li><a href="aboutus" class="<?= $_SERVER['REQUEST_URI'] === '/aboutus' ? 'active' : ''; ?>" id="about-us-link">About Us</a></li>
        </ul>
    </nav>
</header>
