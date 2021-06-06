<?php
    include('db-connect.php');

    if (isset($_GET['loaded']) && isset($_GET['toLoad'])) {
        $loaded = intval($_GET['loaded']);
        $toLoad = intval($_GET['toLoad']);
        $abfrage = mysqli_query($db, 'SELECT * FROM beitaege ORDER BY id DESC');

        $i = 0;
        while ($row = mysqli_fetch_object($abfrage)) {
            if ($i >= $loaded && $i < $loaded + $toLoad) {
                if ($row->status == 'visible') {
                    $title = $row->title;
                    $autor = $row->created_by;
                    $timestamp = strtotime($row->created_at);
                    $created_at_date = date("d.m.Y", $timestamp);
                    $created_at_time = date("H:i", $timestamp);
                    $content = (strlen($row->content) > 300) ? substr($row->content, 0, 300).'...' : $row->content;
                    $id = $row->id;
                    echo "
                    <article>
                        <h1>$title</h1>
                        <span><i>Verfasst von $autor am $created_at_date um $created_at_time</i></span>
                        <p>$content<p>
                        <p><a href='blog.php?id=$id'>Mehr lesen</a></p>
                    </article>";
                }
            }
            $i++;
        }
    }
?>
