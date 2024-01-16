<?php



it('properly sanitize strings')
  ->expect(fn (string $string) => sanitize($string))->toBe('Aa12345')
  ->with(
      ['Aa12345', 'Aa1@2@345', 'Aa12345⭐']
  );
