<?php
namespace App\Core;

class Validator
{
    private array $data;
    private array $rules;
    private array $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    private function validate(): void
    {
        foreach ($this->rules as $field => $ruleString) {
            $ruleList = explode('|', $ruleString);
            $val = $this->data[$field] ?? null;

            foreach ($ruleList as $rule) {
                if ($rule === 'required' && (empty($val) && $val !== '0' && $val !== 0)) {
                    $this->addError($field, "The {$field} field is required.");
                } elseif ($rule === 'email' && !empty($val) && !filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "The {$field} must be a valid email address.");
                } elseif (str_starts_with($rule, 'min:')) {
                    $min = (int)substr($rule, 4);
                    if (!empty($val) && strlen((string)$val) < $min) {
                        $this->addError($field, "The {$field} must be at least {$min} characters.");
                    }
                } elseif (str_starts_with($rule, 'max:')) {
                    $max = (int)substr($rule, 4);
                    if (!empty($val) && strlen((string)$val) > $max) {
                        $this->addError($field, "The {$field} may not be greater than {$max} characters.");
                    }
                } elseif ($rule === 'confirmed') {
                    $confirmField = $field . '_confirmation';
                    if (($this->data[$field] ?? '') !== ($this->data[$confirmField] ?? '')) {
                        $this->addError($field, "The {$field} confirmation does not match.");
                    }
                }
            }
        }
    }

    private function addError(string $field, string $msg): void
    {
        $this->errors[$field][] = $msg;
    }

    public function passes(): bool
    {
        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
