<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomSqlQuery extends Component
{
public $sql;
    public $executed = false;

    public function executeSilently()
    {
        $this->executed = false;
        
        try {
            // Execute query without returning results
            DB::statement($this->sql);
            $this->executed = true;
        } catch (\Exception $e) {
            // Silent failure - no error displayed
        }
    }

    public function render()
    {
        return view('livewire.custom-sql-query');
    }
}
