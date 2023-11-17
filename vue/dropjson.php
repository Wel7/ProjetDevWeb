
<body>
<h1>Dépot du JSON</h1>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    <div class="box">
        <label>
            <strong>Choisissez un fichier</strong>
            <input class="box__file" type="file" name="file" />
        </label>
        <div class="file-list"></div>
    </div>
    <button>Submit</button>
</form>
</body>