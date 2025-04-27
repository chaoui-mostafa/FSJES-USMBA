<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomSqlQuery extends Component
{
    public string $sql = '';
    public mixed $results = null;
    public string|null $error = null;
    public string|null $successMessage = null;

    public function execute()
    {
        $this->error = null;
        $this->successMessage = null;
        $this->results = null;

        try {
            $queryType = strtolower(strtok(trim($this->sql), ' '));

            if (in_array($queryType, ['select'])) {
                $this->results = DB::select($this->sql);
                $this->successMessage = "✅ تم تنفيذ الاستعلام بنجاح.";
            } else {
                DB::statement($this->sql);
                $this->successMessage = "✅ تم تنفيذ العملية بنجاح.";
            }
        } catch (\Exception $e) {
            $this->error = $e->getMessage();
            Log::error("SQL Error: " . $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.custom-sql-query');
    }
}
