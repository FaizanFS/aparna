<?php
/**
 * Trait Purchase_Form_Traits_ButtonDecorator
 */
trait Purchase_Form_Traits_ButtonDecorator
{
    /**
     * Button decorator
     *
     * @return array
     */
    public function getButtonDecorator(): array
    {
        return [
            'ViewHelper',
            [
                ['data' => 'HtmlTag'],
                ['tag' => 'div', 'class' => 'col-sm-12 text-right'],
            ],
            [
                'Label',
                [],
            ],
            [
                ['row' => 'HtmlTag'],
                ['tag' => 'div', 'class' => 'row'],
            ],
        ];
    }
}
