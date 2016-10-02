<?php
/* ===================================================================================== */
/* Copyright 2016 Engin Yapici <engin.yapici@gmail.com>                                  */
/* Created on 09/30/2016                                                                 */
/* Last modified on 10/01/2016                                                           */
/* ===================================================================================== */

/* ===================================================================================== */
/* The MIT License                                                                       */
/*                                                                                       */
/* Copyright 2016 Engin Yapici <engin.yapici@gmail.com>.                                 */
/*                                                                                       */
/* Permission is hereby granted, free of charge, to any person obtaining a copy          */
/* of this software and associated documentation files (the "Software"), to deal         */
/* in the Software without restriction, including without limitation the rights          */
/* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell             */
/* copies of the Software, and to permit persons to whom the Software is                 */
/* furnished to do so, subject to the following conditions:                              */
/*                                                                                       */
/* The above copyright notice and this permission notice shall be included in            */
/* all copies or substantial portions of the Software.                                   */
/*                                                                                       */
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR            */
/* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,              */
/* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE           */
/* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER                */
/* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,         */
/* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN             */
/* THE SOFTWARE.                                                                         */
/* ===================================================================================== */

require_once('../private/include/include.php');

if (!$Session->isSessionValid()) {
    $Functions->phpRedirect('login');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <title>Purchase Order System</title>
        <?php require_once ('include_references.php'); ?>
    </head>

    <body>
        <?php require_once (PRIVATE_PATH . 'require/header.php'); ?>
        <div id="main-toast-wrapper"></div>
        <div id="gray-out-div"></div>
        <img id="progress-bar" src="images/progress-bar.gif"/>
        <div id="home-main-body-wrapper">
            <span id='version-span'>Version 1.0.0.<?php echo file_get_contents($file); ?></span>
            <div id="new-order-request-elements-outer-wrapper">
                <div id="new-order-request-heading" class="heading">New Purchase Order Request</div>
                <table id="new-order-request-table">
                    <tr>
                        <td>
                            <select placeholder="Choose Vendor">
                                <?php echo $Vendors->populateVendorsDropdown();?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div id="main-error-div" class="error-div"></div>
        </div>
    </body>
</html>

