<?php
$current_page_state = "";
if (isset($_GET["cps"]) && !empty($_GET["cps"]))
    $current_page_state = $_GET["cps"];
?>

<!--div class="row text-center">
    <div class="col col-md-12">
        <h4>Getting to know you</h4>
    </div>
</div-->
<nav>
    <div class="nav justify-content-center" id="gtky-tabs" role="tablist">
        <a hidden class="nav-item nav-link active" id="nav-soc-tab"
           data-toggle="tab" href="#nav-soc" role="tab" aria-controls="nav-soc"
           aria-selected="true">Stage of change</a> 
      <a hidden class="nav-item nav-link active" id="nav-soc34-tab"
           data-toggle="tab" href="#nav-soc34" role="tab" aria-controls="nav-soc34"
           aria-selected="true">soc34</a> 
      <a hidden
                                                       class="nav-item nav-link" id="nav-imp-tab" data-toggle="tab"
                                                       href="#nav-imp" role="tab" aria-controls="nav-imp"
                                                       aria-selected="true">Impairments</a> <a hidden
                                                                                               class="nav-item nav-link"
                                                                                               id="nav-bdf-tab"
                                                                                               data-toggle="tab"
                                                                                               href="#nav-bdf"
                                                                                               role="tab"
                                                                                               aria-controls="nav-bdf"
                                                                                               aria-selected="true">Baseline
            screening form</a> <a hidden
                                  class="nav-item nav-link" id="nav-vi-tab" data-toggle="tab"
                                  href="#nav-vi" role="tab" aria-controls="nav-vi" aria-selected="true">Value
            identification</a>


    </div>
</nav>
<form class="text-center" method="post" id="gtky-form" action="/coach_assistant/controller/gtky_process.php" novalidate>
    <div class="tab-content" id="gtky-tabContent">
        <input type="hidden" name="cps" id="cps" >
        <div class="mt-3" role="alert" id="error">
            <!-- error will be shown here ! -->
        </div>

        <div>
          
        </div>
        <div class="tab-pane fade <?php echo ($current_page_state == "soc12" || $current_page_state == NULL) ? "show active" : "" ?>" id="nav-soc" role="tabpanel"
             aria-labelledby="nav-soc-tab">
            <?php
            include_layout_template('forms/stage_of_change12.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "soc34" ? "show active" : "" ?>" id="nav-soc34" role="tabpanel"
             aria-labelledby="nav-soc34-tab">
            <?php
            include_layout_template('forms/stage_of_change34.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "impair" ? "show active" : "" ?>" id="nav-imp" role="tabpanel"
             aria-labelledby="nav-imp-tab">
            <?php
            include_layout_template('forms/impairments.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "impair_ps" ? "show active" : "" ?>" id="nav-imp_ps" role="tabpanel"
             aria-labelledby="nav-imp_ps-tab">
            <?php
            include_layout_template('forms/impairments_ps.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "impair_pf" ? "show active" : "" ?>" id="nav-imp_pf" role="tabpanel"
             aria-labelledby="nav-imp_pf-tab">
            <?php
            include_layout_template('forms/impairments_pf.php');
            ?>
        </div>      
        <div class="tab-pane fade <?php echo $current_page_state == "impair_be" ? "show active" : "" ?>" id="nav-imp_be" role="tabpanel"
             aria-labelledby="nav-imp_be-tab">
            <?php
            include_layout_template('forms/impairments_be.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "impair_ci" ? "show active" : "" ?>" id="nav-imp_ci" role="tabpanel"
             aria-labelledby="nav-imp_ci-tab">
            <?php
            include_layout_template('forms/impairments_ci.php');
            ?>
        </div>   
        <div class="tab-pane fade <?php echo $current_page_state == "baseline" ? "show active" : "" ?>" id="nav-bdf" role="tabpanel"
             aria-labelledby="nav-bdf-tab">
            <?php
            include_layout_template('forms/baseline_kc.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "baseline_sc" ? "show active" : "" ?>" id="nav-bdf_sc" role="tabpanel"
             aria-labelledby="nav-bdf-tab">
            <?php
            include_layout_template('forms/baseline_sc.php');
            ?>
        </div>      
        <div class="tab-pane fade <?php echo $current_page_state == "baseline_cr" ? "show active" : "" ?>" id="nav-bdf_cr" role="tabpanel"
             aria-labelledby="nav-bdf-tab">
            <?php
            include_layout_template('forms/baseline_cr.php');
            ?>
        </div>
        <div class="tab-pane fade <?php echo $current_page_state == "baseline_oh" ? "show active" : "" ?>" id="nav-bdf_oh" role="tabpanel"
             aria-labelledby="nav-bdf-tab">
            <?php
            include_layout_template('forms/baseline_oh.php');
            ?>
        </div>      
        <div class="tab-pane fade <?php echo $current_page_state == "value" ? "show active" : "" ?>" id="nav-vi" role="tabpanel"
             aria-labelledby="nav-vi-tab">
            <?php
            include_layout_template('forms/value_identification.php');
            ?>
        </div>
    </div>
</form>
