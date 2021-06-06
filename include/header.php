<?php
    $isLogin = isset($_SESSION['userid']);
?>
<header>
    <div id="logo">
        <a href="/blog/" title="Titel">
            <img src="/blog/img/logo.png" alt="logo" />
            <span class="logo-text">
                <span class="logo-header">Titel</span><br />Zusatztitle
            </span>
        </a>
    </div>
    <div>
        <input type="checkbox" id="menu-btn" style="display:none;"/>
        <label for="menu-btn" class="menu-btn">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </label>
        <nav class="menu-nav">
            <ul class="menu-list">
                <li><a href="/blog/">Home</a></li>
                <li class="dropdown">Profil
                    <ul class="dropdown-content sublist">
                        <?php
                            if ($isLogin) {
                                echo '<li><a href="/blog/profil/">Mein Profil</a></li>';
                                echo '<li><a href="/blog/profil/logout.php">Logout</a></li>';
                            } else {
                                echo '<li><a href="/blog/profil/login.php">Login</a></li>';
                                echo '<li><a href="/blog/profil/register.php">Registrieren</a></li>';
                            }
                        ?>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>