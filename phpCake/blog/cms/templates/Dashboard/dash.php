<style>
    body {
        background-color: black;
        color: white;
    }

    .banner {
        margin: 20px auto;
        width: 100%;
        height: 200px;
        overflow: hidden;
        text-align: center;
    }

    .banner img {
        width: 100%;
        height: auto;
    }

    .blog-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .blog-list li {
        margin-bottom: 20px;
    }
</style>

<h1 style="color:var(--color-cakephp-red)">Blogs:</h1>

<div class="banner">
    <img src="<?= $this->Url->image('b.jpg') ?>" alt="Banner Image">
</div>
<hr>
<?php foreach ($blogs as $blog): ?>
    <div class="card" style="width: max-width;">
        <div class="card-body" style="background-color:black;">
            <a href="/blog/see/<?php echo $blog->id ?>">
                <h3 class="card-title" style="color:var(--color-cakephp-red)">
                    <?php echo $blog->title; ?>
                </h3>
            </a>
            <p class="card-text" style="color:white">
                <?php echo $blog->short_desc; ?>

            </p>
            <p style="color:var(--color-cakephp-red)"><strong>
                    <?php echo $blog->user->first_name; ?>&nbsp;
                    <?php echo $blog->user->last_name; ?>
                </strong></p>
        </div>
    </div>
    <br>
<?php endforeach; ?>