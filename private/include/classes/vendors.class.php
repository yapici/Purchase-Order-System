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

class Vendors {

    private $Database;
    private $Functions;

    /** @var array $vendorsArray */
    public $vendorsArray;

    /**
     * @param Database $database
     * @param Functions $functions
     */
    function __construct($database, $functions) {
        $this->Database = $database;
        $this->Functions = $functions;
        $this->populateArray();
    }

    private function populateArray() {
        $sql = sprintf("SELECT id, name, phone, website, address FROM %s.vendors WHERE approved != 0 AND deleted = 0 ORDER BY name", Constants::OMS_DB_NAME);

        $stmt = $this->Database->prepare($sql);
        $stmt->execute();
        $this->vendorsArray = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $this->vendorsArray[$row['id']] = $row;
        }
    }

    public function refreshArray() {
        $this->populateArray();
    }

    /**
     * @return array $vendorsArray
     */
    public function getVendorsArray() {
        return $this->vendorsArray;
    }

    public function populateVendorsDropdown() {
        $optionsHtml = "";
        
        foreach ($this->vendorsArray as $vendorId => $vendorDetails) {
            $vendorName = $vendorDetails["name"];
            $optionsHtml .= "<option value='$vendorId'>$vendorName</option>";            
        }
        
        return $optionsHtml;
    }
}
