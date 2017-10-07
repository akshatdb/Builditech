<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        BuildiTech
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('main.css') ?>
    <?= $this->Html->css('fotorama.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <?= $this->Html->script('jquery.min.js') ?>
    <?= $this->Html->script('fotorama.js') ?>
</head>
 
        <body>
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>

        </body>
</html>