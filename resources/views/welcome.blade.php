@extends('layouts.app')

@section('content')
    <style>
        .loader {
            border-top-color: #fff;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        @include('partials.header')

        <main>
            <div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col">
                    <x-logo class="text-indigo-600 h-15"/>
                    <h1 class="text-center text-4xl font-extrabold mb-3">WP Sandbox</h1>
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200 bg-white">
                            <table class="min-w-full">
                                <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b border-t border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider whitespace-no-wrap">
                                        Domaine
                                    </th>
                                    <th class="px-3 py-3 border-b border-t border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider whitespace-no-wrap">
                                        Chemin
                                    </th>
                                    <th class="px-3 py-3 border-b border-t border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider whitespace-no-wrap">
                                        BDD
                                    </th>
                                    <th class="px-6 py-3 border-b border-t border-gray-200 bg-gray-50"></th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                    @foreach($subdomains as $subdomain)
                                        <tr>
                                            <td class="px-6 py-3 whitespace-no-wrap border-gray-200 border-b">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    <a  class="hover:underline text-indigo-600 hover:text-indigo-500"
                                                        href="https://{{$subdomain->domain}}" target="_blank">
                                                        {{$subdomain->domain}}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-no-wrap border-gray-200 border-b">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    <span class="inline-flex px-1.5 py-0.5 rounded text-xs font-medium leading-4 bg-red-100 text-red-800">
                                                        <code>{{$subdomain->documentroot }}</code>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-no-wrap border-gray-200 border-b">
                                                <div class="text-sm leading-5 font-medium text-gray-900">
                                                    @empty($subdomain->softaculous['softdb'])
                                                        &ndash;
                                                    @else
                                                        <span class="inline-flex px-1.5 py-0.5 rounded text-xs font-medium leading-4 bg-red-100 text-red-800">
                                                            <code>{{ $subdomain->softaculous['softdb'] }}</code>
                                                        </span>
                                                    @endempty
                                                </div>
                                            </td>
                                            <td class="px-6 py-3 whitespace-no-wrap text-right border-gray-200 text-sm leading-5 font-medium w-1 opacity-100 border-b">
                                                <div class="flex items-center">
                                                    <livewire:delete-subdomain :domain="$subdomain->domain"/>
                                                    {{--<x-param-button />--}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @livewire('add-subdomain')
            </div>
        </main>
    </div>
@endsection
