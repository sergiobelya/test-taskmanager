
    <head>
        <meta charset="UTF-8">
        <title>Задачник - тестовое задание Белякова Сергея</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script type="text/javascript">
            <?php include docRoot().'/js/script.min.js'; ?>
        </script>
        <script type="text/javascript">
            $script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', 'jquery');
            $script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', 'bootstrap');
            $script('https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/fc-3.2.2/fh-3.1.2/r-2.1.1/sc-1.4.2/datatables.min.js', 'datatable');
            $script('/js/HTML5-History-API/history.min.js', 'history');
            $script('<?= uriStatic('/js/common-func.js') ?>', 'common-func');
            $script.ready('datatable', function() {
                $.extend(true, $.fn.dataTable.defaults, {
                    order: [],
                    lengthMenu: [ [5, 8, 10, 20, 50, 100, -1], [5, 8, 10, 20, 50, 100, "Все"] ],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.13/i18n/Russian.json'
                    }
                });
            });
            $script('<?= uriStatic('/js/common.js') ?>');
        </script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/dt-1.10.13/fc-3.2.2/fh-3.1.2/r-2.1.1/sc-1.4.2/datatables.min.css"/>

        <?= $this->render('partials/head-theme') ?>

    </head>
