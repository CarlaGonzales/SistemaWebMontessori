<ul>
    <?php if ($data->USUARIO_REG) { ?>
        <li>Creación:<br /><?= $data->USUARIO_REG . "<br/>" . $data->FECHA_REG ?></li>
    <?php } ?>
    <?php if ($data->USUARIO_ACT) { ?>
        <li>Actualización:<br /><?= $data->USUARIO_ACT . "<br/>" . $data->FECHA_ACT ?></li>
    <?php } ?>
</ul>