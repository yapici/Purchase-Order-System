<?php
/* ===================================================================================== */
/* Copyright 2016 Engin Yapici <engin.yapici@gmail.com>                                  */
/* Created on 10/01/2016                                                                 */
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

final class Constants {

    // Database details
    const DB_SERVER = 'localhost';
    const DB_USER = 'pos_user';
    const DB_PASS = '9vn3Zrw6r3VStBtX';
    const POS_DB_NAME = 'pos_database';
    const OMS_DB_NAME = 'oms_database';
    
    // Domain name
    const DOMAIN_NAME = 'www.example.com';
    const DOMAIN_NAME_HTTP = 'http://www.example.com';
    const DOMAIN_EMAIL_EXT = 'example.com';
    
    // Webmaster E-mail
    const WEBMASTER_EMAIL = 'engin.yapici@example.com';
    
    private function __construct() {
        throw new Exception("Can't get an instance of Constants");
    }
}
