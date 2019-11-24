@yield('strictSyntax')
namespace {{ $namespace }};
@yield('useSyntax')
class {{ $classname }}{{ $parent }}{{ $interface }}
{
@yield('traitSyntax')
}
