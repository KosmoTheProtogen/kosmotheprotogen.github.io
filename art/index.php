<html lang="PL">
    <head>
        <meta charset="UTF-8">
        <title> Art / Comics | Kosmo's Place</title>
        <link rel="stylesheet" href="/style.css">
        <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    </head>
    <body>
        <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
        <script>
        AOS.init();
        </script>
        <div class="nav" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
            <a href="/">Home</a> <a href="/about">About Me</a> <a href="/hardware">Hardware</a> <a href="/photography">Photography</a> <a class="uarehere" href="/art">Art / Comics</a>
        </div>
        <div class="png" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
            <img src="/img/png.png">
        </div>
        <div class="welcome">
            <h1 data-aos="fade-down-right" data-aos-duration="1000" data-aos-delay="200">Art / Comics</h1>
             <?php
            // Dozwolone rozszerzenia obrazów
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Wczytaj wszystkie pliki z folderu
            $files = array_values(array_filter(scandir(__DIR__), function($file) use ($allowed_extensions) {
                return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), $allowed_extensions);
            }));
            ?>
                <style>
                    .gallery { display: flex; flex-wrap: wrap; justify-content: center; padding: 20px; margin-right: 1000px; }
                    .gallery img {
                        max-width: 200px;
                        max-height: 200px;
                        margin: 10px;
                        cursor: pointer;
                        transition: transform 0.2s;
                        border-radius: 8px;
                    }
                    .gallery img:hover {
                        transform: scale(1.05);
                    }
                    #lightbox {
                        display: none;
                        position: fixed;
                        top: 0; left: 0;
                        width: 100%; height: 100%;
                        background: rgba(0, 0, 0, 0.9);
                        justify-content: center;
                        align-items: center;
                        flex-direction: column;
                        z-index: 9999;
                    }
                    #lightbox img {
                        max-width: 90%;
                        max-height: 80%;
                        border-radius: 10px;
                    }
                    .arrow {
                        position: fixed;
                        top: 50%;
                        transform: translateY(-50%);
                        font-size: 40px;
                        color: white;
                        background: rgba(0, 0, 0, 0.3);
                        border: none;
                        cursor: pointer;
                        padding: 10px 20px;
                        z-index: 10000;
                        border-radius: 5px;
                    }
                    .arrow.left { left: 20px; }
                    .arrow.right { right: 20px; }
                    #counter {
                        color: white;
                        margin-top: 15px;
                        font-size: 18px;
                    }
                </style>

            <div class="gallery" data-aos="zoom-in-up">
                <?php foreach ($files as $index => $file): ?>
                    <img src="<?php echo htmlspecialchars($file); ?>" alt="" onclick="openLightbox(<?php echo $index; ?>)">
                <?php endforeach; ?>
            </div>

            <div id="lightbox" onclick="closeLightbox(event)">
                <button class="arrow left" onclick="prevImage(event)">❮</button>
                <img id="lightbox-img" src="" alt="">
                <button class="arrow right" onclick="nextImage(event)">❯</button>
                <div id="counter"></div>
            </div>

            <script>
                let images = <?php echo json_encode($files); ?>;
                let currentIndex = 0;

                function openLightbox(index) {
                    currentIndex = index;
                    document.getElementById('lightbox').style.display = 'flex';
                    updateLightbox();
                }

                function closeLightbox(event) {
                    if (event.target.id === 'lightbox' || event.key === 'Escape') {
                        document.getElementById('lightbox').style.display = 'none';
                    }
                }

                function nextImage(event) {
                    event.stopPropagation();
                    currentIndex = (currentIndex + 1) % images.length;
                    updateLightbox();
                }

                function prevImage(event) {
                    event.stopPropagation();
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    updateLightbox();
                }

                function updateLightbox() {
                    document.getElementById('lightbox-img').src = images[currentIndex];
                    document.getElementById('counter').textContent =
                        (currentIndex + 1) + " of " + images.length;
                }

                document.addEventListener('keydown', function(e) {
                    if (document.getElementById('lightbox').style.display === 'flex') {
                        if (e.key === 'ArrowRight') nextImage(e);
                        else if (e.key === 'ArrowLeft') prevImage(e);
                        else if (e.key === 'Escape') closeLightbox(e);
                    }
                });
            </script>

            </body>
            </html>


        </div>
        <footer>
            <h3>&copy; 2025 KosmoTheProtogen | Created by <a href="https://matisio.eu">Matisio</a></h3>
        </footer>
    </body>