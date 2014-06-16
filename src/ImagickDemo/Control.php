<?php


namespace ImagickDemo;


interface Control {

    function renderForm();

    function getParams();
    
    function getURL();

    function getCustomImageURL(array $extraParams = []);
}

 