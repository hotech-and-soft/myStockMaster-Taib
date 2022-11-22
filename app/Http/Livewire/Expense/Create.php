<?php

namespace App\Http\Livewire\Expense;

use Livewire\Component;
use App\Models\{Expense, ExpenseCategory, Warehouse};
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Create extends Component
{
    use LivewireAlert;

    public $listeners = ['createExpense'];

    public $reference;
    public $category_id;
    public $date;
    public $amount;
    public $details;
    public $user_id;
    public $warehouse_id;

    public $createExpense;

    public array $listsForFields = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'reference' => 'required|string|max:255',
        'category_id' => 'required|integer|exists:expense_categories,id',
        'date' => 'required',
        'amount' => 'required|numeric',
        'details' => 'nullable|string|max:255',
        'user_id' => 'nullable',
        'warehouse_id' => 'nullable',
    ];

    public function mount()
    {
        $this->date = date('Y-m-d');

        $this->initListsForFields();
    }

    public function render()
    {
        abort_if(Gate::denies('expense_create'), 403);

        return view('livewire.expense.create');
    }

    public function createExpense()
    {
        $this->reset();

        $this->createExpense = true;
    }

    public function create()
    {
        $validatedData = $this->validate();

        $user_id = auth()->user()->id;

        $this->expense->user_id = $user_id;

        Expense::create($validatedData);

        $this->alert('success', __('Expense created successfully.'));

        $this->emit('refreshIndex');

        $this->createExpense = false;
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['expensecategories'] = ExpenseCategory::pluck('name', 'id')->toArray();
        $this->listsForFields['warehouses'] = Warehouse::pluck('name', 'id')->toArray();
    }
}
