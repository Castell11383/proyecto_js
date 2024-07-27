<?php include_once '../includes/header.php'; ?>

<style>
    body {
        background-image: url(../src/images/2.jpg);
        margin-top: 5px;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-size: cover;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background-color: transparent;
        border-radius: 10px;
    }

    .hero {
        text-align: center;
        padding: 50px 20px;
        background-color: rgba(175, 175, 175, 0.9);
    }

    .hero h2 {
        font-size: 3em;
        margin-bottom: 20px;
        color: #0056b3;
    }

    .hero p {
        font-size: 1.2em;
        margin-bottom: 20px;
    }

    .services {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        margin-top: 40px;
    }

    .service {
        flex: 1;
        min-width: 250px;
        margin: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    }

    .service h2 {
        color: #0056b3;
        margin-bottom: 15px;
    }

    .service p {
        font-size: 1em;
    }

    .cta {
        text-align: center;
        margin-top: 50px;
    }

    .cta a {
        display: inline-block;
        padding: 15px 30px;
        font-size: 1.2em;
        color: #fff;
        background-color: #0056b3;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .cta a:hover {
        background-color: #004494;
    }

    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2.5em;
        }

        .hero p {
            font-size: 1em;
        }

        .service {
            margin: 10px;
        }
    }
</style>
</head>

<body>
    <div class="container">
        <div class="hero rounded">
            <h2 class="text-primary">Bienvenido a Nuestra Compañía de Ingeniería de Software</h2>
            <p>Soluciones innovadoras para un mundo digital.</p>
            <p>Nuestro equipo de expertos está aquí para ayudarte a transformar tu visión en realidad.</p>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="cta">
                    <a href="https://www.solusoft.es/servicios/desarrollo-de-software" class="bg-warning">Contáctanos</a>
                </div>
            </div>
            <div class="col">
                <div class="cta">
                    <a href="" class="bg-success">WhatsApp</a>
                </div>
            </div>
        </div>

        <div class="services">
            <div class="service">
                <h2>Desarrollo de Software</h2>
                <p>Ofrecemos servicios de desarrollo de software a medida para satisfacer las necesidades específicas de tu negocio.</p>
            </div>
            <div class="service">
                <h2>Consultoría Tecnológica</h2>
                <p>Nuestros consultores te ayudarán a identificar y implementar las mejores soluciones tecnológicas para tu empresa.</p>
            </div>
            <div class="service">
                <h2>Gestión de Proyectos</h2>
                <p>Gestionamos tus proyectos tecnológicos desde la planificación hasta la implementación, asegurando el éxito en cada etapa.</p>
            </div>

        </div>

    </div>

    <?php include_once '../includes/footer.php'; ?>