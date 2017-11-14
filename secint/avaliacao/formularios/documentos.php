<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Propeller is a front-end responsive framework based on Material design & Bootstrap.">
        <meta content="width=device-width, initial-scale=1, user-scalable=no" name="viewport">
        <title>Accordion - Style - Propeller</title>
        <!-- favicon --> 
        <link rel="icon" href="http://propeller.in/assets/images/favicon.ico" type="image/x-icon">
        <link href="/selecao/includes/selecao/google-icons.css" type="text/css" rel="stylesheet" />
        <link href="/selecao/includes/selecao/accordion.css" type="text/css" rel="stylesheet" /> 
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body>
        <!--Accordion -->
        <div class="pmd-content pmd-content-custom" id="content"> 
            <!--component header -->
            <div class="componant-title-bg"> 
            </div> <!--component header end-->
            <div class="container">
                <!-- Accordion with colored icon-->
                <section class="row component-section">
                    <div class="col-md-9"> 
                        <!--Accordion with colored icon code and example  -->
                        <div class="component-box">
                            <!--Accordion with colored icon example -->
                            <div class="panel-group pmd-accordion" id="accordion4" role="tablist" aria-multiselectable="true" > 

                                <div class="panel panel-warning">                                    
                                    <div class="panel-heading" 
                                         role="tab" 
                                         id="headingOne">
                                        <h4 class="panel-title">
                                            <a 
                                                data-toggle="collapse" 
                                                data-parent="#accordion4" 
                                                href="#collapseOne4" 
                                                aria-expanded="true" 
                                                aria-controls="collapseOne4"  
                                                data-expandable="false">
                                                <i class="material-icons pmd-sm pmd-accordion-icon-left">
                                                    mood
                                                </i> 
                                                Formação Acadêmica  
                                            </a> 
                                        </h4>
                                    </div>                                    
                                    <div 
                                        id="collapseOne4" 
                                        class="panel-collapse collapse in" 
                                        role="tabpanel" 
                                        aria-labelledby="headingOne">
                                        <div class="panel-body">
                                            <?php
                                            include 'identificacao.php';
                                            ?>                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-danger"> 
                                    <div class="panel-heading" 
                                         role="tab" 
                                         id="headingTwo">
                                        <h4 class="panel-title">
                                            <a  
                                                data-toggle="collapse" 
                                                data-parent="#accordion4" 
                                                href="#collapseTwo4" 
                                                aria-expanded="false" 
                                                aria-controls="collapseTwo4"  
                                                data-expandable="false">
                                                <i class="material-icons pmd-sm pmd-accordion-icon-left">
                                                    account_balance
                                                </i> 
                                                Atividades Profissionais e Participação em eventos
                                            </a> 
                                        </h4>
                                    </div>
                                    <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                        <div class="panel-body">Accordions are popular because they allow developers to force large amounts of content into tiny spaces on the page. Granted these content displays also require dynamic effects for switching between page elements – so there are pros and cons to accordions.  </div>
                                    </div>
                                </div>

                                <div class="panel panel-success"> 
                                    <div class="panel-heading" 
                                         role="tab" 
                                         id="headingThree">
                                        <h4 class="panel-title"> 
                                            <a  
                                                data-toggle="collapse" 
                                                data-parent="#accordion4" 
                                                href="#collapseThree4" 
                                                aria-expanded="false" 
                                                aria-controls="collapseThree4"  
                                                data-expandable="false">
                                                <i class="material-icons pmd-sm pmd-accordion-icon-left">
                                                    verified_user
                                                </i> 
                                                Publicação (na área de computação) 
                                            </a> 
                                        </h4>
                                    </div>
                                    <div id="collapseThree4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                        <div class="panel-body">Not every website needs an accordion menu and you certainly won’t find them all the time. But that’s no reason to ignore the concept entirely. The purpose of an accordion menu is to manage an overabundance of content through dynamic switching. Each interface works differently based on the circumstances of the layout. </div>
                                    </div>
                                </div>

                                <div class="panel panel-info"> 
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title"><a  data-toggle="collapse" data-parent="#accordion4" href="#collapseFour4" aria-expanded="false" aria-controls="collapseFour4"  data-expandable="false"><i class="material-icons pmd-sm pmd-accordion-icon-left">account_box</i> Quadro de Observações </a> </h4>
                                    </div>
                                    <div id="collapseFour4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                        <div class="panel-body">So when exactly should you use accordions? Mostly with larger menus or content which might behave cleaner using expandable sections. These could be sub-headings or even multiple levels – the point is to organize content in a way that makes navigation simpler than endless scrolling. </div>
                                    </div>
                                </div>

                            </div> <!--Accordion with colored icon example end-->
                        </div> <!--Accordion with colored icon code and example end -->
                    </div>
                </section> <!-- Accordion with colored icon end -->
            </div>
        </div> <!--Accordion constructor end -->
    </body>    
    <!-- Propeller js --> 
    <script src="/selecao/includes/selecao/accordion.js"></script>
</html>