<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->Html->meta('icon') ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Add other stylesheets or Bootstrap versions as needed -->
    <link rel="stylesheet" type="text/css" href="<?= $this->Url->css('style') ?>">
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>

    <title>BlackBox</title>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<style>
    /* Add this CSS to style the navigation bar and the logo */
    body {
        margin: 0;
        padding: 0;
    }



    .top-nav-title {
        display: flex;
        align-items: center;
    }

    .top-nav-title a {
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .top-nav-title img {
        max-width: 60px;

        max-height: 60px;

        margin-right: 10px;
    }



    .top-nav-links a:hover {
        text-decoration: underline;
    }

    .container {
        margin-top: 20px;
    }

    /* Add additional styles as needed */
</style>


<?php
$currentController = $this->request->getParam('controller');

if ($currentController !== "Login") {
    $isAdmin = $this->request->getSession()->read('key');
}
?>

<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <a href="<?= $this->Url->build('/blog') ?>"><img
                    src="<?= $this->Url->image('ninja.png') ?>"><span>Black</span>Mask</a>

        </div>
        <div class="top-nav-links">
            <?php if (isset($isAdmin)): ?>
                <?php if ($isAdmin === "admin"): ?>
                    <a target="_blank" rel="noopener" href="/dashboard">Dashboard</a>
                    <a target="_blank" rel="noopener" href="/blog">Blogs</a>
                    <a target="_blank" rel="noopener" href="/user">Users</a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($currentController !== "Login"): ?>
                <a target="_blank" rel="noopener" href="/logout">Logout</a>
            <?php endif; ?>





        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>