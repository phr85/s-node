{print_data array=$xt7500_results}

{* beispiel einer liste die mit dem array gefüttert werden kann *}
{subplugin package="ch.iframe.snode.articles" module="list_by_array" ids=$xt7500_results.270 count=100}