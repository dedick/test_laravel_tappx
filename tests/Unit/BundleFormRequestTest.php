<?php

namespace Tests\Feature\Unit;

use App\Http\Requests\StoreBundlePost;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BundleFormRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @var \App\Http\Requests\SaveProductRequest */
    private $rules;

    /** @var \Illuminate\Validation\Validator */
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = app()->get('validator');

        $this->rules = (new StoreBundlePost())->rules();
    }

    public function validationProvider()
    {
        return [
            'request_should_success' => [
                'passed' => true,
                'data' => [
                    'name' => 'application',
                    'bundle' => 'com.app'
                ]
            ],
            'request_should_fail_when_name_doest_not_exist' => [
                'passed' => false,
                'data' => [
                    'bundle' => 'a__3',
                ]
            ],
            'request_should_fail_when_name_contains_incorrect_character' => [
                'passed' => false,
                'data' => [
                    'name' => 'ap_@',
                    'bundle' => 'com.app.f'
                ]
            ],
            'request_should_fail_when_name_is_less_than_4_characters' => [
                'passed' => false,
                'data' => [
                    'name' => 'ap',
                    'bundle' => 'com.app.f'
                ]
            ],
            'request_should_fail_when_name_doest_not_comply_two_letters_or_numbers' => [
                'passed' => false,
                'data' => [
                    'name' => 'a__-',
                    'bundle' => 'com.app.f'
                ]
            ],
            'request_should_fail_when_bundle_doest_not_exist' => [
                'passed' => false,
                'data' => [
                    'name' => 'a__3',
                ]
            ],
            'request_should_fail_when_bundle_doest_not_comply_min_requirement' => [
                'passed' => false,
                'data' => [
                    'name' => 'a_-3',
                    'bundle' => 'com'
                ]
            ],
            'request_should_fail_when_bundle_finish_with_a_dot' => [
                'passed' => false,
                'data' => [
                    'name' => 'application',
                    'bundle' => 'com.'
                ]
            ],
            'request_should_fail_when_bundle_start_with_a_letter_after_a_dot' => [
                'passed' => false,
                'data' => [
                    'name' => 'a__3',
                    'bundle' => 'com.1'
                ]
            ],
            'request_should_fail_when_bundle_have_a_non_alphanumeric_character' => [
                'passed' => false,
                'data' => [
                    'name' => 'a__3',
                    'bundle' => 'com.p@ckage'
                ]
            ],
        ];
    }

    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validation_results_as_expected($shouldPass, $mockedRequestData)
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    protected function validate($mockedRequestData)
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }
}
