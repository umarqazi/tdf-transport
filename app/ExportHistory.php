<?php 
namespace LaravelAcl\Exports;

class ExportHisory implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return Invoice::all();
    }
}
?>