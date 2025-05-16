<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/img/logo.webp" type="image/x-icon">
    <title>CENRO Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<style>
    .mission-vision-container {
    display: flex;
    gap: 40px;
    justify-content: center;
    align-items: stretch;
    flex-wrap: wrap;
}
.mission-box, .vision-box {
    background: #e8f5e9;
    border: 2px solid #388e3c;
    border-radius: 12px;
    padding: 24px 20px;
    min-width: 260px;
    box-shadow: 0 4px 16px rgba(56, 142, 60, 0.08);
}
.hero h1 {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 20px;
    color: #fff;
    text-shadow: 3px 3px 12px rgba(34, 56, 34, 0.7), 0 2px 8px #388e3c;
    letter-spacing: 2px;
}
</style>
<body>
    <header class="header">
        <div class="container">
            <div class="logo-container">
                <img src="assets/img/logo.webp" alt="PlayFullBistro Logo" class="logo-img" style="margin:  0px 20px 0px -20px">
                <h1 class="logo-text">CENRO Records</h1>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="login.php" class="login-btn"style="margin:  -10px 0px 0px 0px">Login</a></li>
                </ul>
                
            </nav>
        </div>
    </header>



    <section class="hero">
        <div class="hero-content">
            <p><br></p>
            <h1>Welcome to CENRO Manolo Fortich</h1>
            <p><br><br></p>
           
        </div>
    </section>

    <section id="about" class="about-section">
    <div class="container">
        <h2>About Us</h2>
        <div class="container mission-vision-container">
        <div class="mission-box" style="flex:1;">
            <h3>DENR's Mission</h3>
            <p>
                To mobilize the citizenry to protect, conserve, and manage the environment and natural resources for present and future generations.
            </p>
        </div>
        <div class="vision-box" style="flex:1;">
            <h3>DENR's Vision</h3>
            <p>
                A nation enjoying and sustaining its natural resources and a clean and healthy environment.
            </p>
        </div>
    </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure nobis sint neque voluptas eveniet corrupti quidem repudiandae aliquid quae quis, cum tempora distinctio possimus omnis totam doloremque facilis quisquam voluptatum perspiciatis autem tempore. Quis molestias modi officia accusantium expedita distinctio deleniti veritatis perspiciatis recusandae numquam odio amet magnam reiciendis, ea temporibus omnis! Natus doloribus nisi commodi fugiat quas mollitia cumque, inventore repudiandae dignissimos voluptatum aliquid reiciendis expedita! Sit earum mollitia nostrum dolore quisquam! Officiis maxime placeat tempora incidunt enim, voluptatum asperiores ipsam animi, tenetur voluptates non expedita doloremque reprehenderit quo iure temporibus? Hic doloribus odio, quos iusto quo expedita esse!</p>
        <div class="about-images">
            <img src="assets/img/model1.webp" alt="model 1">
            <img src="assets/img/model2.webp" alt="model 2">
            <img src="assets/img/model3.webp" alt="model 3">
        </div>
    </div>
</section>


    <section id="contact" class="contact-section">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions? Get in touch!</p>
            <p>Email: <a href="mailto:info@cenr.com">info@cenro.com</a></p>
            <p>Phone: <a href="tel:+1234567890">+1 234 567 890</a></p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> DENR-CENRO. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
