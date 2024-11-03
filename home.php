<style>

    body {
        font-family: 'Roboto', sans-serif;
        color: #333;
    }
    
    .banner-img-holder {
        height: 25vh !important;
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .banner-img {
        object-fit: cover;
        height: 100%;
        width: 100%;
        transition: transform .5s ease;
    }
    .car-item:hover .banner-img {
        transform: scale(1.15);
    }

    .car-item {
        display: flex;
        align-items: center;
        padding: 1em;
        margin: 1em 0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .car-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        background: rgba(165, 165, 165, 0.1);
    }

    .car-cover {
        width: 10em;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .car-item .col-auto {
        max-width: calc(100% - 12em) !important;
        padding-left: 1em;
    }

    .card.card-primary {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
    }
    .card-body {
        padding: 2em;
    }

    h3.text-center {
        font-weight: 600;
        color: #007bff;
        margin-bottom: 0.5em;
    }
    hr {
        border: 0;
        height: 1px;
        background: #007bff;
        width: 80px;
        margin: 0.5em auto;
    }
</style>

<div class="card card-outline card-primary shadow bg-gradient2">
    <div class="card-body">
        <div class="container-fluid">
            <h3 class="text-center">About Us</h3>
            <hr>
            <?php include("about_us.html") ?>
        </div>
    </div>
</div>