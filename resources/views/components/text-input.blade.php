@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'block mt-1 w-full rounded-lg border-gray-300 focus:border-[#FFC403] focus:ring-[#FFC403] text-gray-700']) }}>