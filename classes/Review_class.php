<?

class Review 
{
    private $database;

    public function __construct()
    {
        //Get the current instance of the DB
        $this->database = DB::getInstance();
    }

    public function InsertReview($productID, $score, $message)
    {
        //implemented with Tyler Truman

        $db = DB::getInstance();

        $data = array( 
            'rev_Score'=>$score,
            'rev_Detail' => $message, 
            'pro_ID' => $productID, 
            'cus_ID'=>'13'
         );

        $insert = $db->filter($data);
        $db->clean($insert);

        $db->insert('review', $insert);
    }

    public function PrintReview($prod_id)
    {
        $query = "select * from review inner join customer on review.cus_ID=customer.cus_ID where pro_ID=$prod_id";
        $results = $this->database->get_results($query);

        return $results;
        
    }

    public function CalculateScore($prod_id)
    {
        $query = "select ROUND(AVG(rev_Score), 1) as score from review inner join customer on customer.cus_ID = review.cus_ID where pro_ID = $prod_id";
        $results = $this->database->get_results($query);
        
        return $results;
    }

}



?>