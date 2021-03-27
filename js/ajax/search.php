<?
    //database connection
    require_once("../../config.php");

    $database = new DB();

    $words = explode(" ", $_POST['query']);
    foreach ($words as $word)
    {
        $search .= (!empty($search) ? " OR " : "") . " pro_Name LIKE '%" . $word . "%' ";
        $search2 .= (!empty($search2) ? " OR " : "") . " cat_Name LIKE '%" . $word . "%' ";
    }
    $q = "select pro_ID id, cat_Name category, pro_Name name, pro_Price price from product p, category c where p.cat_ID=c.cat_ID and
            ($search or $search2) order by cat_Name, pro_Name";
    $data = $database->get_results($q);

    // convert our results to json
    echo json_encode($data);

?>