
<form class="form-horizontal" id="xxxxx" method="post">


    <ul class="nav nav-pills nav-tabs" style="margin-bottom: 15px;">
        <li class="list active"><a href="#Step1" data-toggle="tab"><span class="badge">1</span> Datos personales</a>
        </li>

        <li><a href="#Step4" data-toggle="tab" onclick="location.href = '../instrucciones/'"><span class="badge">2</span> Instrucción</a>

        <li>
            <a href="explaboral" data-toggle="tab" onclick="location.href = '../explaboral'">
                <span class="badge">3</span> Experiencia laboral</a>
        </li>
        <li><a href="#Step4" data-toggle="tab" onclick="location.href = '../histcapacitacion/'"><span class="badge">4</span> Capacitación específica</a>
        <li><a href="#Step5" data-toggle="tab" onclick="location.href = '../idioma/'"><span class="badge">5</span> Conocimiento de idiomas</a>      
        <li><a href="#Step6" data-toggle="tab" onclick="location.href = '../publicacion/'"><span class="badge">6</span> Publicaciones.</a>
        <li><a href="#Step7" data-toggle="tab" onclick="location.href = '../proyecto/'"><span class="badge">7</span> Proyectos.</a>
        <li><a href="#Step8" data-toggle="tab" onclick="location.href = '../tesis/'"><span class="badge">8</span> Tesis.</a>
        </li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="Step1">
            <fieldset>

                <ul class="nav nav-pills">
                    <?php if ($flag == false): ?>
                        <li class='<?php echo Arr::get($subnav, "create"); ?>'><?php echo Html::anchor('infopersonal/create', 'Create'); ?></li>
                    <?php else: ?>
                        <li class='<?php echo Arr::get($subnav, "edit"); ?>'><?php echo Html::anchor('infopersonal/edit', 'Edit'); ?></li>
                        <li class='<?php echo Arr::get($subnav, "view"); ?>'><?php echo Html::anchor('infopersonal/view', 'Ver'); ?></li>

                    <?php endif; ?>
                </ul>

            </fieldset>
        </div>

    </div>


</form>
