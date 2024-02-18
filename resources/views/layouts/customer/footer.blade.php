@php
    $quickLinks = [
        [
            'title' => 'Company Info',
            'elements' => [
                [
                    'path' => '#',
                    'label' => 'How it works',
                ],
                [
                    'path' => '#',
                    'label' => 'Carrier',
                ],
                [
                    'path' => '#',
                    'label' => 'We are hiring',
                ],
                [
                    'path' => '#',
                    'label' => 'Blog',
                ],
            ],
        ],
        [
            'title' => 'Legal',
            'elements' => [
                [
                    'path' => '#',
                    'label' => 'How it works',
                ],
                [
                    'path' => '#',
                    'label' => 'Carrier',
                ],
                [
                    'path' => '#',
                    'label' => 'We are hiring',
                ],
                [
                    'path' => '#',
                    'label' => 'Blog',
                ],
            ],
        ],
        [
            'title' => 'Features',
            'elements' => [
                [
                    'path' => '#',
                    'label' => 'Business Marketing',
                ],
                [
                    'path' => '#',
                    'label' => 'User Analytics',
                ],
                [
                    'path' => '#',
                    'label' => 'Live chat',
                ],
                [
                    'path' => '#',
                    'label' => 'Unlimited Support',
                ],
            ],
        ],
        [
            'title' => 'Resources',
            'elements' => [
                [
                    'path' => '#',
                    'label' => 'IOS & Android',
                ],
                [
                    'path' => '#',
                    'label' => 'Watch a Demo',
                ],
                [
                    'path' => '#',
                    'label' => 'Customers',
                ],
                [
                    'path' => '#',
                    'label' => 'API',
                ],
            ],
        ],
    ];
@endphp

<footer class='bg-gray-100'>
    <div class='py-5 px-5 md:px-10 lg:px-20 lg:py-10 flex flex-col gap-10'>
        <div class='flex flex-col gap-8 lg:flex-row lg:justify-between lg:items-center'>
            <h1>
                <a href="/">MonFreelance</a>
            </h1>
        </div>

        <hr class='hidden md:block' />

        <div class='flex justify-between flex-col xl:flex-row gap-10'>
            <div class='grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 xl:gap-20'>
                @foreach ($quickLinks as $quickLink)
                    <div>
                        <h3 class='mb-10'>{{ $quickLink['title'] }}</h3>

                        <div class='flex flex-col gap-5'>
                            @foreach ($quickLink['elements'] as $element)
                                <a href='{{ $element['path'] }}'
                                    class='hover:underline hover:underline-offset-4 w-max text-gray-600'>
                                    {{ $element['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            <div class='basis-full max-w-[400px] xl:basis-auto'>
                <h3>Get in touch</h3>

                <form action='' class='flex gap-0 items-stretch mt-10'>
                    <input type='text' placeholder='Your Email'
                        class='focus-visible:ring-0 rounded-s rounded-e-none block' />

                    <button class='btn' type='submit'>
                        Subscribe
                    </button>
                </form>
                <p class='text-gray-600 mt-3'>Subscribe to our newsletter</p>
            </div>
        </div>
    </div>
    <div class='py-5 px-5 md:px-10 lg:px-20 lg:py-10 bg-gray-50'>
        <p>Made with love by MonFreelance. All rights reserved</p>
    </div>
</footer>
