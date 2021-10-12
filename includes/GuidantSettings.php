<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( ! class_exists( 'GuidantSettings' ) ) {
    class GuidantSettings
    {
        function __construct() {

            $defaultOption = array();

            if(!get_option("wpguidant_guides")){
                update_option( 'wpguidant_guides', $defaultOption );
            }
            if(!get_option("wpguidant_guide_settings")){
                update_option( 'wpguidant_guide_settings', $defaultOption );
            }
            if(!get_option("wpguidant_filters")){
                update_option( 'wpguidant_filters', $defaultOption );
            }
            if(!get_option("wpguidant_filter_settings")){
                update_option( 'wpguidant_filter_settings', $defaultOption );
            }
            if(!get_option("wpguidant_elements")){
                update_option( 'wpguidant_elements', $defaultOption );
            }
            if(!get_option("wpguidant_element_settings")){
                update_option( 'wpguidant_element_settings', $defaultOption );
            }
            if(!get_option("wpguidant_conditions")){
                update_option( 'wpguidant_conditions', $defaultOption );
            }
            if(!get_option("wpguidant_condition_settings")){
                update_option( 'wpguidant_condition_settings', $defaultOption );
            }
            if(!get_option("wpguidant_fields")){
                update_option( 'wpguidant_fields', $defaultOption );
            }
            if(!get_option("wpguidant_field_settings")){
                update_option( 'wpguidant_field_settings', $defaultOption );
            }
            if(!get_option("wpguidant_submissions")){
                update_option( 'wpguidant_submissions', $defaultOption );
            }

            if(!get_option("wpguidant_submissions_data")){
                update_option( 'wpguidant_submissions_data', $defaultOption );
            }


            if(!get_option("wpguidant_results")){
                update_option( 'wpguidant_results', $defaultOption );
            }
            if(!get_option("wpguidant_result_settings")){
                update_option( 'wpguidant_result_settings', $defaultOption );
            }


            if(!get_option("wpguidant_logics")){
                update_option( 'wpguidant_logics', $defaultOption );
            }
            if(!get_option("wpguidant_logic_settings")){
                update_option( 'wpguidant_logic_settings', $defaultOption );
            }
        }


        /* ****************** Guide Logic Operations ****************** */

        public function createNewLogic($guide_id){
            $dataLogics = get_option("wpguidant_logics");
            $logic_id = $this->generateLogicID($dataLogics);
            $dataLogics[] = array("guide_id" => $guide_id, "logic_id" => $logic_id);
            update_option( 'wpguidant_logics', $dataLogics );

            return $logic_id;
        }

        public function deleteLogic($logic_id){
            $dataFreshLogic = array();
            $dataLogics = get_option("wpguidant_logics");
            foreach ($dataLogics as $singleData){
                if(isset($singleData['logic_id'])){
                    if($singleData['logic_id'] != $logic_id){
                        $dataFreshLogic[] = $singleData;
                    }
                }
            }

            $dataFreshLogicSettings = array();
            $dataLogicSettings = get_option("wpguidant_logic_settings");
            foreach ($dataLogicSettings as $singleData){
                if(isset($singleData['logic_id'])){
                    if($singleData['logic_id'] != $logic_id){
                        $dataFreshLogicSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_logics', $dataFreshLogic );
            update_option( 'wpguidant_logic_settings', $dataFreshLogicSettings );
        }

        public function listAllLogics($guide_id){
            $dataLogicsByGuide = array();
            $dataLogics = get_option("wpguidant_logics");
            foreach ($dataLogics as $singleData){
                if(isset($singleData['guide_id'])){
                    if($singleData['guide_id'] == $guide_id){
                        $dataLogicsByGuide[] = $singleData;
                    }
                }
            }
            return $dataLogicsByGuide;
        }


        public function updateLogicSettings($logic_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataLogicSettings = get_option("wpguidant_logic_settings");
            $dataNewLogicSettings = array();
            foreach ($dataLogicSettings as $singleSettings){
                if(isset($singleSettings['logic_id']) && isset($singleSettings['key'])){
                    if($singleSettings['logic_id'] == $logic_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewLogicSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_logic_settings', $dataNewLogicSettings );
            }else if(!$exits && $value != Null){
                $dataNewLogicSettings[] = array("logic_id" => $logic_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_logic_settings', $dataNewLogicSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }



        public function generateLogicID($resultData)
        {
            $exits = false;
            $length = 9;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($resultData as $singleResult){
                if(isset($singleResult['logic_id'])){
                    if($singleResult['logic_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateLogicID($resultData);
        }





        /* ****************** Guide Results Operations ****************** */

        public function createNewResult($guide_id){
            $dataResults = get_option("wpguidant_results");
            $result_id = $this->generateResultID($dataResults);
            $dataResults[] = array("guide_id" => $guide_id, "result_id" => $result_id);
            update_option( 'wpguidant_results', $dataResults );

            $this->updateResultSettings($result_id, "position", '9999');

            return $result_id;
        }

        public function deleteResult($result_id){
            $dataFreshResults = array();
            $dataResults = get_option("wpguidant_results");
            foreach ($dataResults as $singleData){
                if(isset($singleData['result_id'])){
                    if($singleData['result_id'] != $result_id){
                        $dataFreshResults[] = $singleData;
                    }
                }
            }

            $dataFreshResultSettings = array();
            $dataResultSettings = get_option("wpguidant_result_settings");
            foreach ($dataResultSettings as $singleData){
                if(isset($singleData['result_id'])){
                    if($singleData['result_id'] != $result_id){
                        $dataFreshResultSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_results', $dataFreshResults );
            update_option( 'wpguidant_result_settings', $dataFreshResultSettings );
        }

        public function listAllResults($guide_id){
            $dataResultsByGuide = array();
            $dataResults = get_option("wpguidant_results");
            foreach ($dataResults as $singleData){
                if(isset($singleData['guide_id'])){
                    if($singleData['guide_id'] == $guide_id){
                        $singleData['position'] = $this->updateResultSettings($singleData['result_id'], "position");
                        $dataResultsByGuide[] = $singleData;
                    }
                }
            }

            $sort = array_column($dataResultsByGuide, 'position');
            array_multisort($sort, SORT_ASC, $dataResultsByGuide);

            return $dataResultsByGuide;
        }


        public function updateResultSettings($result_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataResultsSettings = get_option("wpguidant_result_settings");
            $dataNewResultSettings = array();
            foreach ($dataResultsSettings as $singleSettings){
                if(isset($singleSettings['result_id']) && isset($singleSettings['key'])){
                    if($singleSettings['result_id'] == $result_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewResultSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_result_settings', $dataNewResultSettings );
            }else if(!$exits && $value != Null){
                $dataNewResultSettings[] = array("result_id" => $result_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_result_settings', $dataNewResultSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }



        public function generateResultID($resultData)
        {
            $exits = false;
            $length = 9;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($resultData as $singleResult){
                if(isset($singleResult['result_id'])){
                    if($singleResult['result_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateResultID($resultData);
        }


        /* ****************** Submission Operations ****************** */

        public function recordNewSubmission($guide_id, $user_id, $time){
            $dataSubmissions = get_option("wpguidant_submissions");
            $submission_id = $this->generateSubmissionID($dataSubmissions);
            $dataSubmissions[] = array("submission_id" => $submission_id, "guide_id" => $guide_id, "user_id" => $user_id, "time" => $time);
            update_option( 'wpguidant_submissions', $dataSubmissions );
            return $submission_id;
        }


        public function deleteSubmission($submission_id){
            $dataFreshSubmissions = array();
            $dataSubmissions = get_option("wpguidant_submissions");
            foreach ($dataSubmissions as $singleData){
                if(isset($singleData['submission_id'])){
                    if($singleData['submission_id'] != $submission_id){
                        $dataFreshSubmissions[] = $singleData;
                    }
                }
            }

            $dataFreshSubmissionSettings = array();
            $dataSubmissionSettings = get_option("wpguidant_submissions_data");
            foreach ($dataSubmissionSettings as $singleData){
                if(isset($singleData['submission_id'])){
                    if($singleData['submission_id'] != $submission_id){
                        $dataFreshSubmissionSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_submissions', $dataFreshSubmissions );
            update_option( 'wpguidant_submissions_data', $dataFreshSubmissionSettings );
        }

        public function listAllSubmissions($guide_id){
            $dataSubmissionsByGuide = array();
            $dataSubmissions = get_option("wpguidant_submissions");
            foreach ($dataSubmissions as $singleSubmission){
                if(isset($singleSubmission['guide_id'])){
                    if($guide_id == 0 || $singleSubmission['guide_id'] == $guide_id){
                        $dataSubmissionsByGuide[] = $singleSubmission;
                    }
                }
            }
            return array_reverse($dataSubmissionsByGuide);
        }

        public function generateSubmissionID($dataSubmissions)
        {
            $exits = false;
            $length = 8;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($dataSubmissions as $singleSubmission){
                if(isset($singleField['submission_id'])){
                    if($singleField['submission_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateSubmissionID($dataSubmissions);
        }

        public function insertSubmissionData($submission_id, $element_id, $value){
            $dataSubmissionValues = get_option("wpguidant_submissions_data");
            $dataSubmissionValues[] = array("submission_id" => $submission_id, "element_id" => $element_id, "value" => $value);
            update_option( 'wpguidant_submissions_data', $dataSubmissionValues );
        }

        public function getSubmissionDataByElement($submission_id, $element_id){
            $dataValues = get_option("wpguidant_submissions_data");
            foreach ($dataValues as $singleValue){
                if(isset($singleValue['submission_id']) && isset($singleValue['element_id'])){
                    if($singleValue['submission_id'] == $submission_id && $singleValue['element_id'] == $element_id){
                        return $singleValue['value'];
                    }
                }
            }
            return Null;
        }


        /* ****************** Custom Field Operations ****************** */

        public function createNewField(){
            $dataFields = get_option("wpguidant_fields");
            $field_id = $this->generateFieldID($dataFields);
            $dataFields[] = array("field_id" => $field_id);
            update_option( 'wpguidant_fields', $dataFields );
            return $field_id;
        }

        public function deleteField($field_id){
            $dataFreshFields = array();
            $dataFields = get_option("wpguidant_fields");
            foreach ($dataFields as $singleData){
                if(isset($singleData['field_id'])){
                    if($singleData['field_id'] != $field_id){
                        $dataFreshFields[] = $singleData;
                    }
                }
            }

            $dataFreshFieldSettings = array();
            $dataFieldSettings = get_option("wpguidant_field_settings");
            foreach ($dataFieldSettings as $singleData){
                if(isset($singleData['field_id'])){
                    if($singleData['field_id'] != $field_id){
                        $dataFreshFieldSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_fields', $dataFreshFields );
            update_option( 'wpguidant_field_settings', $dataFreshFieldSettings );
            delete_post_meta_by_key($field_id);
        }


        public function listAllFields(){
            $dataFields = get_option("wpguidant_fields");
            return is_array($dataFields) ? $dataFields : Null;
        }

        public function updateFieldSettings($field_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataFieldSettings = get_option("wpguidant_field_settings");
            $dataNewFieldSettings = array();
            foreach ($dataFieldSettings as $singleSettings){
                if(isset($singleSettings['field_id']) && isset($singleSettings['key'])){
                    if($singleSettings['field_id'] == $field_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewFieldSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_field_settings', $dataNewFieldSettings );
            }else if(!$exits && $value != Null){
                $dataNewFieldSettings[] = array("field_id" => $field_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_field_settings', $dataNewFieldSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }

        public function generateFieldID($fieldData)
        {
            $exits = false;
            $length = 6;
            $key = "wpguidant_field_".substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($fieldData as $singleField){
                if(isset($singleField['field_id'])){
                    if($singleField['field_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateFieldID($fieldData);
        }




        /* ****************** Guide Operations ****************** */

        public function createNewGuide($guide_name){
            $dataGuides = get_option("wpguidant_guides");
            $guide_id = $this->generateGuideID($dataGuides);
            $dataGuides[] = array("guide_id" => $guide_id);
            update_option( 'wpguidant_guides', $dataGuides );

            $this->updateGuideSettings($guide_id, "guide_name", $guide_name);
            return $guide_id;
        }

        public function deleteGuide($guide_id){


            /* Delete Filters under Guide */
            $list_filters = $this->listAllFilters($guide_id);
            foreach ($list_filters as $single_filter){
                $this->deleteFilter($single_filter['filter_id']);
            }


            /* Delete Result Attributes under Guide */
            $list_results = $this->listAllResults($guide_id);
            foreach ($list_results as $single_result){
                $this->deleteResult($single_result['result_id']);
            }

            /* Delete Submission Records under Guide */
            $list_submissions = $this->listAllSubmissions($guide_id);
            foreach ($list_submissions as $single_submission){
                $this->deleteSubmission($single_submission['submission_id']);
            }


            /* Delete Logics under Guide */
            $list_logics = $this->listAllLogics($guide_id);
            foreach ($list_logics as $single_logic){
                $this->deleteLogic($single_logic['logic_id']);
            }


            $dataFreshGuides = array();
            $dataGuides = get_option("wpguidant_guides");
            foreach ($dataGuides as $singleData){
                if(isset($singleData['guide_id'])){
                    if($singleData['guide_id'] != $guide_id){
                        $dataFreshGuides[] = $singleData;
                    }
                }
            }

            $dataFreshGuideSettings = array();
            $dataGuideSettings = get_option("wpguidant_guide_settings");
            foreach ($dataGuideSettings as $singleData){
                if(isset($singleData['guide_id'])){
                    if($singleData['guide_id'] != $guide_id){
                        $dataFreshGuideSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_guides', $dataFreshGuides );
            update_option( 'wpguidant_guide_settings', $dataFreshGuideSettings );
        }


        public function listAllGuides(){
            $dataGuides = get_option("wpguidant_guides");
            return is_array($dataGuides) ? $dataGuides : Null;
        }

        public function updateGuideSettings($guide_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataGuideSettings = get_option("wpguidant_guide_settings");
            $dataNewGuideSettings = array();
            foreach ($dataGuideSettings as $singleSettings){
                if(isset($singleSettings['guide_id']) && isset($singleSettings['key'])){
                    if($singleSettings['guide_id'] == $guide_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewGuideSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_guide_settings', $dataNewGuideSettings );
            }else if(!$exits && $value != Null){
                $dataNewGuideSettings[] = array("guide_id" => $guide_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_guide_settings', $dataNewGuideSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }

        public function generateGuideID($guideData)
        {
            $exits = false;
            $length = 6;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($guideData as $singleGuide){
                if(isset($singleGuide['guide_id'])){
                    if($singleGuide['guide_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateGuideID($guideData);
        }







        /* ****************** Filter Operations ****************** */

        public function createNewFilter($guide_id){
            $dataFilters = get_option("wpguidant_filters");
            $filter_id = $this->generateFilterID($dataFilters);
            $dataFilters[] = array("guide_id" => $guide_id, "filter_id" => $filter_id);
            update_option( 'wpguidant_filters', $dataFilters );

            $this->updateFilterSettings($filter_id, "position", '9999');

            return $filter_id;
        }

        public function deleteFilter($filter_id){

            /* Delete Elements under Filter */
            $list_elements = $this->listAllElementsByFilterID($filter_id);
            foreach ($list_elements as $single_element){
                $this->deleteElement($single_element['element_id']);
            }

            $dataFreshFilters = array();
            $dataFilters = get_option("wpguidant_filters");
            foreach ($dataFilters as $singleData){
                if(isset($singleData['filter_id'])){
                    if($singleData['filter_id'] != $filter_id){
                        $dataFreshFilters[] = $singleData;
                    }
                }
            }

            $dataFreshFilterSettings = array();
            $dataFilterSettings = get_option("wpguidant_filter_settings");
            foreach ($dataFilterSettings as $singleData){
                if(isset($singleData['filter_id'])){
                    if($singleData['filter_id'] != $filter_id){
                        $dataFreshFilterSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_filters', $dataFreshFilters );
            update_option( 'wpguidant_filter_settings', $dataFreshFilterSettings );
        }

        public function listAllFilters($guide_id){
            $dataFiltersByGuide = array();
            $dataFilters = get_option("wpguidant_filters");
            foreach ($dataFilters as $singleFilter){
                if(isset($singleFilter['guide_id'])){
                    if($singleFilter['guide_id'] == $guide_id){
                        $singleFilter['position'] = $this->updateFilterSettings($singleFilter['filter_id'], "position");
                        $dataFiltersByGuide[] = $singleFilter;
                    }
                }
            }

            $sort = array_column($dataFiltersByGuide, 'position');
            array_multisort($sort, SORT_ASC, $dataFiltersByGuide);

            return $dataFiltersByGuide;
        }

        public function updateFilterSettings($filter_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataFilterSettings = get_option("wpguidant_filter_settings");
            $dataNewFilterSettings = array();
            foreach ($dataFilterSettings as $singleSettings){
                if(isset($singleSettings['filter_id']) && isset($singleSettings['key'])){
                    if($singleSettings['filter_id'] == $filter_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewFilterSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_filter_settings', $dataNewFilterSettings );
            }else if(!$exits && $value != Null){
                $dataNewFilterSettings[] = array("filter_id" => $filter_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_filter_settings', $dataNewFilterSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }

        public function generateFilterID($filterData)
        {
            $exits = false;
            $length = 6;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($filterData as $singleFilter){
                if(isset($singleFilter['filter_id'])){
                    if($singleFilter['filter_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateFilterID($filterData);
        }



        /* ****************** Element Operations ****************** */

        public function createNewElement($filter_id, $element_type){
            $dataElements = get_option("wpguidant_elements");
            $element_id = $this->generateElementID($dataElements);
            $dataElements[] = array("filter_id" => $filter_id, "element_id" => $element_id, "element_type" => $element_type);
            update_option( 'wpguidant_elements', $dataElements );

            $this->updateElementSettings($element_id, "position", '9999');

            return $element_id;
        }
        public function deleteElement($element_id){

            /* Delete Conditions under Element */
            $list_conditions = $this->listAllConditions($element_id);
            foreach ($list_conditions as $single_condition){
                $this->deleteCondition($single_condition['condition_id']);
            }

            $dataFreshElements = array();
            $dataElements = get_option("wpguidant_elements");
            foreach ($dataElements as $singleData){
                if(isset($singleData['element_id'])){
                    if($singleData['element_id'] != $element_id){
                        $dataFreshElements[] = $singleData;
                    }
                }
            }

            $dataFreshElementSettings = array();
            $dataElementSettings = get_option("wpguidant_element_settings");
            foreach ($dataElementSettings as $singleData){
                if(isset($singleData['element_id'])){
                    if($singleData['element_id'] != $element_id){
                        $dataFreshElementSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_elements', $dataFreshElements );
            update_option( 'wpguidant_element_settings', $dataFreshElementSettings );
        }

        public function listAllElements($filter_id, $element_type){
            $dataElementsByFilter = array();
            $dataElements = get_option("wpguidant_elements");
            foreach ($dataElements as $singleElement){
                if(isset($singleElement['filter_id'])){
                    if($singleElement['filter_id'] == $filter_id && $singleElement['element_type'] == $element_type){
                        $singleElement['position'] = $this->updateElementSettings($singleElement['element_id'], "position");
                        $dataElementsByFilter[] = $singleElement;
                    }
                }
            }

            $sort = array_column($dataElementsByFilter, 'position');
            array_multisort($sort, SORT_ASC, $dataElementsByFilter);


            return $dataElementsByFilter;
        }
        public function listAllElementsByFilterID($filter_id){
            $dataElementsByFilter = array();
            $dataElements = get_option("wpguidant_elements");
            foreach ($dataElements as $singleElement){
                if(isset($singleElement['filter_id'])){
                    if($singleElement['filter_id'] == $filter_id){
                        $dataElementsByFilter[] = $singleElement;
                    }
                }
            }
            return $dataElementsByFilter;
        }

        public function updateElementSettings($element_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataElementSettings = get_option("wpguidant_element_settings");
            $dataNewElementSettings = array();
            foreach ($dataElementSettings as $singleSettings){
                if(isset($singleSettings['element_id']) && isset($singleSettings['key'])){
                    if($singleSettings['element_id'] == $element_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewElementSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_element_settings', $dataNewElementSettings );
            }else if(!$exits && $value != Null){
                $dataNewElementSettings[] = array("element_id" => $element_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_element_settings', $dataNewElementSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }

        public function generateElementID($elementData)
        {
            $exits = false;
            $length = 6;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($elementData as $singleElement){
                if(isset($singleElement['element_id'])){
                    if($singleElement['element_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateElementID($elementData);
        }


        /* ****************** Condition Operations ****************** */

        public function createNewCondition($element_id){
            $dataConditions = get_option("wpguidant_conditions");
            $condition_id = $this->generateConditionID($dataConditions);
            $dataConditions[] = array("element_id" => $element_id, "condition_id" => $condition_id);
            update_option( 'wpguidant_conditions', $dataConditions );
            return $condition_id;
        }

        public function deleteCondition($condition_id){
            $dataFreshConditions = array();
            $dataConditions = get_option("wpguidant_conditions");
            foreach ($dataConditions as $singleData){
                if(isset($singleData['condition_id'])){
                    if($singleData['condition_id'] != $condition_id){
                        $dataFreshConditions[] = $singleData;
                    }
                }
            }

            $dataFreshConditionSettings = array();
            $dataConditionSettings = get_option("wpguidant_condition_settings");
            foreach ($dataConditionSettings as $singleData){
                if(isset($singleData['condition_id'])){
                    if($singleData['condition_id'] != $condition_id){
                        $dataFreshConditionSettings[] = $singleData;
                    }
                }
            }
            update_option( 'wpguidant_conditions', $dataFreshConditions );
            update_option( 'wpguidant_condition_settings', $dataFreshConditionSettings );
        }

        public function listAllConditions($element_id){
            $dataConditionsByElement = array();
            $dataConditions = get_option("wpguidant_conditions");
            foreach ($dataConditions as $singleCondition){
                if(isset($singleCondition['element_id'])){
                    if($singleCondition['element_id'] == $element_id){
                        $dataConditionsByElement[] = $singleCondition;
                    }
                }
            }
            return $dataConditionsByElement;
        }


        public function updateConditionSettings($condition_id, $key, $value = Null){
            $exits = false;
            $exitingValue = Null;
            $dataConditionSettings = get_option("wpguidant_condition_settings");
            $dataNewConditionSettings = array();
            foreach ($dataConditionSettings as $singleSettings){
                if(isset($singleSettings['condition_id']) && isset($singleSettings['key'])){
                    if($singleSettings['condition_id'] == $condition_id && $singleSettings['key'] == $key){
                        $exits = true;
                        $exitingValue = $singleSettings['value'];
                        $singleSettings['value'] = ($value != Null) ? $value : $singleSettings['value'];
                    }
                }
                if($value != Null){
                    $dataNewConditionSettings[] = $singleSettings;
                }
            }
            if($exits && $value != Null){
                update_option( 'wpguidant_condition_settings', $dataNewConditionSettings );
            }else if(!$exits && $value != Null){
                $dataNewConditionSettings[] = array("condition_id" => $condition_id, "key" => $key, "value" => $value);
                update_option( 'wpguidant_condition_settings', $dataNewConditionSettings );
            }else if($exits && $value == Null){
                return stripslashes($exitingValue);
            }
        }



        public function generateConditionID($conditionData)
        {
            $exits = false;
            $length = 8;
            $key = substr(str_shuffle(str_repeat($x = '123456789', ceil($length / strlen($x)))), 1, $length);
            foreach ($conditionData as $singleCondition){
                if(isset($singleCondition['condition_id'])){
                    if($singleCondition['condition_id'] == $key){
                        $exits = true;
                    }
                }
            }
            return (!$exits) ? $key : $this->generateConditionID($conditionData);
        }

    }

}