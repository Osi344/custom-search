<?php
function frenchMonthLiteral($i){
    $months= [ '','janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre' ];
    return $months[$i];
}
?>

<div class="form-group col-12 col-md-6"> 
    <!-- <label for="">Date</label> -->
    <ul class="form-date-ul">
        <li class="list-group-item">
            <label for="select-day">Jour</label>
            <select class="form-control" id="select-day" name="day">
                <option value="">--</option>
                <?php for ($i=1; $i<=31; $i+=1) : ?>
                    <option value="<?= $i; ?>" <?php if (isset($_GET['day']) && ($_GET['day'] == $i)) : ?> selected <?php endif; ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </li>
        <li class="list-group-item">
            <label for="select-month">Mois</label>
            <select class="form-control" id="select-month" name="month">
                <option value="">--</option>
                <?php for ($i=1; $i<=12; $i+=1) : ?>
                    <option value="<?= $i; ?>" <?php if (isset($_GET['month']) && ($_GET['month'] == $i)) : ?> selected <?php endif; ?>>
                        <?= frenchMonthLiteral($i) ?>
                    </option>
                <?php endfor; ?>
            </select>
        </li>
        <li class="list-group-item">
            <label for="select-year">Année</label>
            <select class="form-control" id="select-year" name="year">
                <option value="">--</option>
                <?php 
                $today = getdate();
                $begin= $today['year'];
                for ($i=$begin; $i>=1995; $i-=1) : ?>
                    <option value="<?= $i; ?>" <?php if (isset($_GET['year']) && ($_GET['year'] == $i)) : ?> selected <?php endif; ?>>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
            </select>
        </li>
    </ul>
</div>