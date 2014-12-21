<?php


namespace ImagickDemo\Control;

use Intahwebz\Request;
use ImagickDemo\Queue\TaskQueue;

class ControlComposite implements \ImagickDemo\Control {
    
    private $imageBaseURL;
    private $customImageBaseURL;
    private $imageStatusBaseURL;


    function __construct($activeCategory, $activeExample, TaskQueue $taskQueue) {
        $this->imageBaseURL = getImageURL($activeCategory, $activeExample);
        $this->customImageBaseURL = getCustomImageURL($activeCategory, $activeExample);
        $this->imageStatusBaseURL = getImageStatusURL($activeCategory, $activeExample);
        $this->taskQueue = $taskQueue;
    }
    
    /**
     * @return array
     */
    function getParams() {
        //This should get replaced by the Weaver
        return [];
    }

    function getInjectionParams() {
        //This should get replaced by the Weaver
        return [];
    }
    
    
    /**
     * @return array
     */
    function getFullParams(array $extraParams = []) {
        $params = $this->getInjectionParams();
        $params += $extraParams;
        return $params;
    }

    /**
     * @return string
     */
    function renderFormElement() {
        //This should get replaced by the Weaver
        return "";
    }

//    /**
//     * @param $imgURL
//     * @return string
//     */
//    private function renderAsyncImage($imgURL) {
//        $output = "";
//        $statusURL = $this->getImageStatusURL();
//
//        $output .= sprintf(
//            "<span id='asyncImageLoad' data-statusuri='%s' data-imageuri='%s'  id='asyncImageHolder'></span>",
//            addslashes($statusURL),
//            addslashes($imgURL)
//        );
//
//        return $output;
//    }

    /**
     * @param null $originalImageURL
     * @return string
     */
    function renderImageURL($originalImageURL = null) {
        return renderImageURL(
            $this->taskQueue->isActive(),
            $this->getURL(),
            $originalImageURL,
            $this->getImageStatusURL()
        );
    }

    /**
     * @param $extraParams
     * @return string
     */
    function renderCustomImageURL($extraParams) {
        return renderImageURL(
            $this->taskQueue->isActive(),
            $this->getCustomImageURL($extraParams),
            false,
            $this->getImageStatusURL()
        );
    }


//        /**
//     * @return string
//     */
//    function renderImageURLBlah($originalImageURL = null) {
//        $js = '';
//        $imgURL = $this->getURL();
//        $originalImage = $originalImageURL;
//
//        $output = '';
//        $asyncImage = "";
//
//        $tempImgURL = $imgURL;
//        
//        if ($this->taskQueue->isActive()) {
//            $asyncImage = $this->renderAsyncImage($imgURL);
//            $tempImgURL = '/images/loading.gif';
//        }
//
//        $newWindow = sprintf(
//            "<a href='%s' target='_blank'>View modified in new window.</a>",
//            $imgURL
//        );
//
//        $originalText = "Touch/mouse over to see original ";
//        $modifiedText = "Touch/mouse out to see modified ";
//
//        if ($originalImage == true) {
//            $modifiedImage = $this->getURL();
//
//            $changeToOriginal = sprintf(
//                "$('#exampleImage').attr('src', '%s' ); $('#mouseText').text('%s')",
//                addslashes($originalImage),
//                addslashes($modifiedText)
//            );
//
//            $changeToModified = sprintf(
//                "$('#exampleImage').attr('src', '%s' ); $('#mouseText').text('%s')",
//                addslashes($modifiedImage),
//                addslashes($originalText)
//            );
//
//            $mouseOver = "onmouseover=\"$changeToOriginal\"\n";
//            $mouseOut = "onmouseout=\"$changeToModified\" \n";
//            $touch = sprintf(
//                "ontouchstart=\"toggleImage('#exampleImage', '#mouseText', '%s', '%s', '%s', '%s')\"",
//                $originalImage,
//                $originalText,
//                $modifiedImage,
//                $modifiedText
//            );
//
//            $js = $mouseOver.' '.$mouseOut.' '.$touch;
//        }
//
//
//        $output .= $asyncImage;
//
//        $output .= sprintf(
//            "<img src='%s' id='exampleImage' class='img-responsive' %s />",
//            $tempImgURL,
//            $js
//        );
//
//        if ($originalImage == true) {
//            $output .= "<div class='row'>";
//            $output .= "<div class='col-xs-12 text-center' style='font-size: 12px'>";
//
//            $output .= "<span id='mouseText'>";
//            $output .= $originalText;
//            $output .= "</span>";
//            $output .= $newWindow;
//            $output .= "</div>";
//
//            $output .= "</div>";
//        }
//
//        return $output;
//    }


    /**
     * @return string
     */
    function renderForm() {

        $output =

        "<form method='GET' accept-charset='utf-8'>
             <div class='col-xs-12 contentPanel controlForm'>";

        $output .= $this->renderFormElement();

        $output .= "
            <div class='row inputSubmitRow'>
                <div class='col-sm-5 col-sm-offset-7'>
                    <button type='submit' class='btn btn-default'>Update</button>
                </div>
            </div>
        </div>
        </form>";

        return $output;
    }

    /**
     * @return string
     */
    function getURL() {
        return $this->getURLWithParams($this->imageBaseURL);
    }

    /**
     * @param $baseURL
     * @return string
     */
    function getURLWithParams($baseURL, $extraParams = []) {
        $paramString = '';
        $params = $this->getParams();
        $params = array_merge($params, $extraParams);
        $separator = '?';
        foreach ($params as $key => $value) {
            $paramString .= $separator.$key."=".$value;
            $separator = '&';
        }

        return $baseURL.$paramString;
    }

    /**
     * @return string
     */
    function getImageStatusURL($extraParams = []) {
        return $this->getURLWithParams($this->imageStatusBaseURL);
    }

    /**
     * @param array $extraParams
     * @return string
     */
    function getCustomImageURL(array $extraParams = []) {
        $paramString = '';
        $params = $this->getParams();
        $separator = '?';
        foreach ($params as $key => $value) {
            $paramString .= $separator.$key."=".$value;
            $separator = '&';
        }

        foreach ($extraParams as $key => $value) {
            $paramString .= $separator.$key."=".$value;
            $separator = '&';
        }

        return $this->customImageBaseURL.$paramString;
    }
}