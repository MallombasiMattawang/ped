<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use App\Admin\Forms\AccProject;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;

class AccProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Acc Project controller';

    public function accForm(Content $content)
    {
        return $content
            ->title('Acc Project Controll')
            ->body(new AccProject());
    }


}
