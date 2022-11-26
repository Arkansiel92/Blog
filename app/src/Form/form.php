<?php

namespace App\Form;

class form
{
    private $formCode = '';

    public function create() 
    {
        return $this->formCode;
    }

    public static function validate(array $form, array $champs)
    {
        foreach($champs as $champ) {
            if (!isset($form[$champ]) || empty($form[$champ])) {
                return false;
            }
        }
        return true;
    }

    private function addAttributs(array $attributs): string
    {
        $strAttributs = '';

        $courtsAttr = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 'novalidate', 'formnovalidate'];

        foreach($attributs as $attribut => $valeur) {
            if (in_array($attribut, $courtsAttr) && $valeur == true) {
                $strAttributs .= " $attribut";
            } else {
                $strAttributs .= " $attribut='$valeur'";
            }
        }

        return $strAttributs;
    }

    public function startForm(string $method = 'post', string $action = '#', array $attributs = []): self
    {
        $this->formCode .= "<form action='$action' method ='$method'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

        return $this;
    }

    public function endForm(): self
    {
        $this->formCode .= "</form>";

        return $this;
    }

    public function addLabelFor(string $for, string $text, array $attributs = []): self
    {
        $this->formCode .= "<label for ='$for'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$text</label>";

        return $this;
    }

    public function addInput(string $type, string $name, array $attributs = []): self
    {
        $this->formCode .= "<input type ='$type' name='$name'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

        return $this;
    }

    public function addTextArea(string $name, string $value = "", array $attributs = []): self
    {
        $this->formCode .= "<textarea name ='$name'";

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$value</textarea>";        


        return $this;
    }

    public function addButton(string $text, array $attributs = []): self
    {
        $this->formCode .= '<button ';

        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

        $this->formCode .= ">$text</button>";

        return $this;
    }
}