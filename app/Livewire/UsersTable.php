<?php

namespace App\Livewire;

use App\Models\User;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
  protected $model = User::class;

  public function configure(): void
  {
    $this->setPrimaryKey('id');
  }

  public function columns(): array
  {
    return [
      Column::make('Name')
        ->sortable()
        ->searchable(),
      Column::make('E-mail', 'email')
        ->sortable()
        ->searchable(),
      Column::make('Address', 'email')
        ->sortable()
        ->searchable()
        ->collapseOnTablet(),
    ];
  }
}
