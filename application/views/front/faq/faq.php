<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($header['title']) ? $header['title'] : ''; ?></title>
        <meta name="keywords" content="<?php echo isset($header['keywords']) ? $header['keywords'] : ''; ?>">
        <meta name="description" content="<?php echo isset($header['description']) ? $header['description'] : ''; ?>">
        <link rel="stylesheet" href="<?php echo base_url(); ?>media/front/css/bootstrap.css" media="screen">
        <script src="<?php echo base_url(); ?>media/front/js/jquery-1.10.2.min.js"></script>

        <script>
            jQuery(document).ready(function(e) {
                jQuery(".panel-heading").bind("click", handleClickOfQuestion);
                jQuery(".panel-heading").css("cursor", "pointer");
            });

            function handleClickOfQuestion()
            {

                if (jQuery(this).find(".btn-faq").hasClass("glyphicon-chevron-right"))
                {
                    jQuery(this).next(".panel-body").hide().removeClass("hidden").show("fast");
                    jQuery(this).find(".btn-faq").removeClass("glyphicon-chevron-right").addClass("glyphicon-chevron-down");
                }
                else
                {
                    jQuery(this).next(".panel-body").addClass("hidden");
                    jQuery(this).find(".btn-faq").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-right");
                }
            }
        </script>
    </head>
    <body>

        <div class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 id="buttons">Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
            <div>

                <section>
                    <div class="panel-group">
                        <?php
                        foreach ($faq_question_details as $faq) {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><div class="row"><div class="col-lg-11"><?php echo stripslashes($faq['question']); ?></div><div class="col-lg-1 text-right"><a  href="javascript:void(0)"><span class="glyphicon glyphicon-chevron-right btn-faq" ></span></a></div></div></div>
                                <div class="panel-body hidden"><?php echo stripslashes($faq['answer']); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </section>
                <br>

            </div>
        </div>
