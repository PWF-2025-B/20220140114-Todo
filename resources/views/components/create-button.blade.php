@props(['href'])  

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center  
   text-white text-black border border-gray-300  
   dark:bg-gray-800 focus:outline-none  
   focus:ring-4 focus:ring-gray-100  
   dark:border-gray-600  
   dark:bg-gray-700 dark:text-white dark:focus:ring-gray-700']) }}>  
    {{ $slot }}  
    Create  
</a>  