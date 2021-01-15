<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{    
    private $translator;

    public function __construct(TranslatorInterface $trans)
    {
        $this->translator = $trans;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Login',
                'empty_data' => null,
                'constraints' => new NotBlank([
                    'message' => $this->translator->trans('Login.login_blank')
                ])
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => $this->translator->trans('Login.password_invalid'),
                'first_options' => [
                    'label' => 'Password'
                ],
                'second_options' => [
                    'label' => "Confirm",
                    'error_bubbling' => false
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => $this->translator->trans('Login.password_blank'),
                    ]),
                    new Regex([
                        "pattern" => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
                        "message" => $this->translator->trans('Login.password_pattern'),
                    ])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'crsf_protection' => true
        ]);
    }
}