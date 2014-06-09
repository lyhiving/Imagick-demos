<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{$pageTitle}</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/imagick.css" rel="stylesheet">
    <link href="/css/colpick.css" rel="stylesheet">
    <!-- IE8 shims deleted - use a decent browser -->
</head>

<body>

<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <nav class="navbar-default" role="navigation">
            <ul class="nav navbar-nav">
                {inject name='navBar' value='ImagickDemo\NavigationBar'}
                {$navBar->render() | nofilter}
                <li class='navbar-right'><a href="https://github.com/Danack/Imagick-demos" target='_blank'>Source code</a></li>
            </ul>
        </nav>
    </div>
</header>

{inject name='nav' value='ImagickDemo\Navigation\Nav'}
{inject name='control' value='ImagickDemo\Control'}
{inject name='example' value='ImagickDemo\Example'}
{inject name='docHelper' value='ImagickDemo\DocHelper'}

<div class='container'>

    <div class="row">
        <div class="col-md-2" style="font-size: 12px">
            {$nav->renderNav()}
        </div>

        <div class="col-md-10">

            <div class="row">
                <div class="col-md-8">
                    <h4 class='noMarginTop'>{$example->renderTitle() | nofilter}</h4>
                </div>
                <div class="col-md-4" style='text-align: right'>
                    {$nav->renderPreviousLink() | nofilter}
                    {$nav->renderNextLink() | nofilter}
                </div>
            </div>
            
            <div class="row">

                <div class="col-md-8">
                    {$example->render() | nofilter}
                </div>

                <div class="col-md-4">
                    {$control->renderForm() | nofilter}
                    <!-- <br/>
                    <span style='min-height: 30px'>&nbsp;</span>

                    <div class="row">
                        <div class="col-md-6">
                            {$nav->renderPreviousButton() | nofilter}
                        </div>
                        <div class="col-md-3" style='text-align: right'>
                            {$nav->renderNextButton() | nofilter}
                        </div>
                    </div> -->
                    
                </div>
            </div>
            <div class="row">
                
                <div class="col-md-12">
                    {$docHelper->showDoc() | nofilter}
                </div>
            </div>
    

            <div class="row">
                <div class="col-md-12">
                    {$docHelper->showExamples() | nofilter}
                </div>
            </div>
            
        </div>

    </div>
    <div>
        <?php
        echo "<br/><br/><br/><span style='font-size: 8px; display: block;'>Peak memory ". number_format(memory_get_peak_usage())." - <a href='/info'>Status</a> </span>";
        ?> 
    </div>
</div>  


<script src="/js/jquery-1.11.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/colpick.js"></script>


<script type="text/javascript">
    
    //http://colpick.com/plugin - I love you color picker
    
    function addColorSelector(selector, targetElement) {
    
        var params = {
            colorScheme:'dark',
            layout:'rgbhex',
            color:'ff8800',
            submit: false,
            onChange:function(hsb, hex, rgb, el) {
                $(el).children().css('background-color', '#' + hex);
                $(targetElement).val("rgb("+ rgb.r + ", " + rgb.g + ", " + rgb.b + ")")
            },
        };

        var startColor = $(selector).data('color');

        if (startColor !== undefined) {
            params.color = startColor;
        }

        $(selector).colpick(params);
    }

    //These are currently hardcoded - todo add JS page injection.
    addColorSelector("#backgroundColorSelector", "#backgroundColor");
    addColorSelector("#colorSelector", "#color");
    addColorSelector("#strokeColorSelector", "#strokeColor");
    addColorSelector("#fillColorSelector", "#fillColor");
    addColorSelector("#fillModifiedColorSelector", "#fillModifiedColor");
    addColorSelector("#textUnderColorSelector", "#textUnderColor");
    addColorSelector("#gradientStartColorSelector", "#gradientStartColor");
    addColorSelector("#gradientEndColorSelector", "#gradientEndColor");
    addColorSelector("#thresholdColorSelector", "#thresholdColor");

</script>



</body>
</html>
