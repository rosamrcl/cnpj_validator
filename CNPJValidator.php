<?php
class CNPJValidator{
    public function isValid(string $cnpj):bool{
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        if(strlen($cnpj) !=14){
            return false;
        }

        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        $firstDigit = $firstDigit = $this->calculateDigit(substr($cnpj, 0, 12), [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);
        if($cnpj[12] != $firstDigit){
            return false;
        }
        $secondDigit = $this->calculateDigit(substr($cnpj, 0, 13), [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]);
        if($cnpj[13] != $secondDigit){
            return false;
        }
        return true;
        
    }

    private function calculateDigit(string $base, array $multipliers): string{
        $sum = 0;

        for ($i=0; $i <strlen($base); $i++){
            $sum+= $base[$i] * $multipliers[$i];
        }

        $remainder = $sum % 11;

        if ($remainder <2){
            return '0';
        }else{
            return (string)(11-$remainder);
        }
    }
}

?>