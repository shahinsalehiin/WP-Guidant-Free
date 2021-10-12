<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id']) && isset($_REQUEST['page'])) {

        $submissionsList = array();

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);
        $page = sanitize_text_field($_REQUEST['page']);



        $list_submissions = $this->settings->listAllSubmissions($guide_id);
        foreach ($list_submissions as $single_submission){


            $user_info = get_userdata($single_submission['user_id']);
            $user_name = ($user_info) ? $user_info->display_name : "Anonymous";
            $user_url = ($user_info) ? admin_url( 'user-edit.php?user_id=').$single_submission['user_id'] : "#";


            $submissionsList[] = array(
                "submission_id" => esc_attr($single_submission['submission_id']),
                "guide_id" => esc_attr($single_submission['guide_id']),
                "guide_name" => esc_attr($this->settings->updateGuideSettings($single_submission['guide_id'], "guide_name")),
                "user_id" => esc_attr($single_submission['user_id']),
                "user_name" => esc_attr($user_name),
                "user_profile" => esc_url($user_url),
                "time" => esc_attr(date( 'd/m/Y H:i:s', $single_submission['time'])),
            );
        }






        /* --- Pagination --- */
        $page_size = 100;
        $total_records = count($submissionsList);
        $total_pages   = ceil($total_records / $page_size);
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        if ($page < 1) {
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $submissionsList = array_slice($submissionsList, $offset, $page_size);
        /* --- Pagination --- */








        $result = array("status" => 'true', "total_page" => $total_pages, "submissions" => $submissionsList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);