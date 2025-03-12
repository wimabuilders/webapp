<?php

use function Laravel\Folio\{middleware, name};

middleware(['verified']);
name('dashboard');
?>

<x-layouts.app>
    <x-app.container x-data class="lg:space-y-6" x-cloak>

        <!-- <x-app.alert id="dashboard_alert" class="hidden lg:flex">This is the user dashboard where users can manage
            settings and access features. <a href="https://devdojo.com/wave/docs" target="_blank"
                                             class="mx-1 underline">View the docs</a> to learn more.
        </x-app.alert> -->

        <x-app.heading
            title="Dashboard"
            description="Welcome to your Wima Builders dashboard."
            :border="false"
        />

        <div class="flex flex-col w-full mt-6 space-y-5 md:flex-row lg:mt-0 md:space-y-0 md:space-x-5">
            <x-app.dashboard-card
                href="{{ route('properties.index') }}"
                title="Properties"
                description="Post your properties today to increase visibility and connect with interested buyers, investors, and tenants."
                link_text="Manage your properties"
                image="https://res.cloudinary.com/dvtzmwl3l/image/upload/v1741817215/real-estate_hbh0tr.png"
            />
            <x-app.dashboard-card
                href="{{ route('professions.index') }}"
                title="Professional profile"
                description="Showcase your expertise and increase your visibility to potential clients, contractors, and partners."
                link_text="Manage your professional profiles"
                image="https://res.cloudinary.com/dvtzmwl3l/image/upload/v1741817215/profile-icon_hapmf2.png"
            />
        </div>

        <!-- <div class="flex flex-col w-full mt-5 space-y-5 md:flex-row md:space-y-0 md:mb-0 md:space-x-5">
            <x-app.dashboard-card
                href="https://github.com/thedevdojo/wave"
                target="_blank"
                title="Github Repo"
                description="View the source code and submit a Pull Request"
                link_text="View on Github"
                image="/wave/img/laptop.png"
            />
            <x-app.dashboard-card
                href="https://devdojo.com"
                target="_blank"
                title="Resources"
                description="View resources that will help you build your SaaS"
                link_text="View Resources"
                image="/wave/img/globe.png"
            />
        </div>

        <div class="mt-5 space-y-5">
            @subscriber
            <p>You are a subscribed user with the <strong>{{ auth()->user()->roles()->first()->name }}</strong> role.
                Learn <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank"
                         class="underline">more about roles</a> here.</p>
            <x-app.message-for-subscriber/>
            @else
                <p>This current logged in user has a <strong>{{ auth()->user()->roles()->first()->name }}</strong> role.
                    To upgrade, <a href="{{ route('settings.subscription') }}" class="underline">subscribe to a plan</a>.
                    Learn <a href="https://devdojo.com/wave/docs/features/roles-permissions" target="_blank"
                             class="underline">more about roles</a> here.</p>
                @endsubscriber

                @admin
                <x-app.message-for-admin/>
                @endadmin
        </div> -->
    </x-app.container>
</x-layouts.app>
