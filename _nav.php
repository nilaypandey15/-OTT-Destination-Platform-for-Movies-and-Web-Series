<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WATCHVIBE</title>
    <link rel="stylesheet" href="style.css">
    <script src="search.js"></script>
    <script src="movie.js"></script>
</head>

<body>

    <div class="main">
        <nav>
            <span><img width="53" src="assets/img/NEWLOGO.png" alt=""></span>
            <div>
                <button class="btn">English</button>
                <a href="/mvs/sign.php">
                    <button class="btn btn-red-sm">Sign In</button>
                </a>
                <a href="/mvs/login.php">
                    <button class="btn btn-red-sm">Login In</button>
                </a>
                <a href="/mvs/index.php">
                    <button class="btn btn-red-sm">SUBSCRIBE</button>
                </a>
                
            </div>
        </nav>

        <div class="box"></div>

        <div class="hero">
            <span>Experience blockbuster movies, popular series, and more starting from just ₹149.</span>
            <span>Join today. Cancel anytime.</span>
            <span>Ready to watch? Enter your email to create or restart your membership.</span>
            <div class="part">
                <div class="hero-buttons">
                    <input type="text" placeholder="Email Address">
                    <button class="btn btn-red">Get Started &gt;</button>
                </div>
                <div class="container">
                    <div class="search-side">
                        <h1>Movie Search</h1>
                        <form id="searchForm">
                            <label for="searchInput">Search for a movie:</label>
                            <input type="text" id="searchInput" name="searchInput">
                            <button type="submit" style="background-color: rgb(172, 17, 128);">Search</button>
                        </form>
                    </div>
                    <div class="results-side">
                        <div id="results"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="separation"></div>

        
        

        <div class="separation"></div>

        <div class="carousel">
            <p style="color:white ; font-weight: bold;">POPULAR MOVIES</p>
            <div id="carousel-box" class="carousel-box">
                <!-- Movie posters will be inserted here -->
            </div>
            <button id="prevBtn">Previous</button>
            <button id="nextBtn">Next</button>
        </div>

        <div class="separation"></div>

        <section class="first">
            <div>
                <span>Enjoy on your TV</span>
                <span>Watch on smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray players and more.</span>
            </div>

            <div class="secImg">
                <img src="assets/img/tv.png" alt="">
                <video src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/video-tv-in-0819.m4v"
                    autoplay loop muted></video>
            </div>
        </section>

        <div class="separation"></div>

        <section class="first second">
            <div class="secImg">
                <img src="assets/img/photo5.png" alt="">
            </div>
            <div>
                <span>Download your shows to watch offline</span>
                <span>Save your favourites easily and always have something to watch.</span>
            </div>
        </section>

        <div class="separation"></div>

        <section class="first third">
            <div>
                <span>Watch everywhere</span>
                <span>Stream unlimited movies and TV shows on your phone, tablet, laptop, and TV.</span>
            </div>

            <div class="secImg">
                <img src="https://assets.nflxext.com/ffe/siteui/acquisition/ourStory/fuji/desktop/tv.png" alt="">
                <video src="assets/video/video.m4v" autoplay loop muted></video>
            </div>
        </section>

        <div class="separation"></div>

        <section class="first second">
            <div class="secImg">
                <img src="https://occ-0-2849-3646.1.nflxso.net/dnm/api/v6/19OhWN2dO19C9txTON9tvTFtefw/AAAABVr8nYuAg0xDpXDv0VI9HUoH7r2aGp4TKRCsKNQrMwxzTtr-NlwOHeS8bCI2oeZddmu3nMYr3j9MjYhHyjBASb1FaOGYZNYvPBCL.png?r=54d"
                    alt="">
            </div>
            <div>
                <span>Create profiles for kids</span>
                <span>Allow children to journey alongside their favorite characters in an exclusive space tailored just
                    for them—accessible at no additional cost with your membership.</span>
            </div>
        </section>

        <div class="separation"></div>

        <footer>
            <div class="questions">
                Questions? Call 000-800-919-1694
            </div>
            <div class="footer">
                <div class="footer-item">
                    <a href="faq">About Us</a>
                    <a href="faq">Contact Us</a>
                    <a href="faq">Terms of Use</a>
                </div>

                <div class="footer-item">
                    <a href="faq">Help Center</a>
                    <a href="faq">Privacy Policy</a>
                </div>
                <div class="footer-item">
                    <a href="faq">Content Guidelines</a>
                    <a href="faq">Cookie Policy</a>
                </div>

                <div class="footer-item">
                    <a href="faq">Careers</a>
                    <a href="faq">Press</a>
                </div>
            </div>
        </footer>
    </div>

</body>

</html>
