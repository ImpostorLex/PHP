<style>
    body {
        background-color: black;
        margin: 0;
        padding: 0;
    }

    #bannerimage {
        position: relative;
        width: 100%;
        height: 405px;
        background-position: center;
        overflow: hidden;
    }

    #bannerimage::before {
        content: '';
        background-image: url(<?php echo $this->Url->build('/uploads/' . $blog->imgs); ?>);
        background-position: center;
        background-size: cover;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        filter: blur(8px);
        -webkit-filter: blur(2px);
    }

    h1 {
        color: white;
        font-family: Arial;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        width: 80%;
        padding: 20px;
        text-align: center;
    }
</style>

<div id="bannerimage">
    <h1>
        <?php echo $blog->title; ?>
    </h1>
</div>
<hr>
<a href="/dashboard"><i class="fa-solid fa-circle-chevron-left fa-2xl text-white"></i></a>

<br>
<br>
<div class="card" style="width: max-width; background-color: #1E1E1E;">
    <div class="card-body">
        <h3 class="card-title" style="color:var(--color-cakephp-red)">
            <?php echo $blog->short_desc; ?>
        </h3>
        <h4 class="card-text text-white">Some quick example text to build on the card title and make up the bulk of the
            card's
            content.</h4>
        <p style="color:var(--color-cakephp-red)"><strong>Author:</strong>
            <?php echo $blog->user->first_name ?>&nbsp;
            <?php echo $blog->user->last_name ?>
        </p>
    </div>
</div>