<section class="w-full">
    <livewire:ads.display-ads-banner :locationKey="'header_banner'" />
    <header class="bg-white border-b border-gray-200 dark:bg-zinc-900 dark:border-zinc-700">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center px-4 py-2 md:py-6 space-y-2 md:space-y-0">
            <div class="flex-1 w-full md:w-auto text-center md:text-left">
            <p class="text-[15px]">
                    {{ \App\Helpers\BanglaDateHelper::formattedLineOne() }}
                </p>
                <p class="text-[15px]">
                    {{ \App\Helpers\BanglaDateHelper::formattedLineTwo() }}
                </p>
            </div>
            <div class="flex justify-center flex-1 w-full md:w-auto order-first md:order-none mb-2 md:mb-0 h-16 md:h-20 max-h-20">
                @php
                    $website = App\Models\Website::first();
                @endphp
                <a href="{{ route('home') }}"
                    wire:navigate 
                    class="flex items-center justify-center max-h-full">
                    @if ($website && $website->logo)
                       <img src="{{ asset('storage/' . $website->logo) }}" class="h-full w-auto" alt="Site Logo">
                    @else
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPoAAABQCAYAAAAwa2i1AAAAAXNSR0IArs4c6QAADYtJREFUeF7tneWuHDkQhfuGmZkZ3/8t8jfMzMy8+lqqUd2K3TDTnb0TH0ur1SYet+tUnSK7excuXLjwu9IQAkLgn0ZgQUT/p/Ur4YRAjYCILkMQAgUgIKIXoGSJKAREdNmAECgAARG9ACVLRCEgossGhEABCIjoBShZIgoBEV02IAQKQEBEL0DJElEIiOiyASFQAAIiegFKlohCQESXDQiBAhAQ0QtQskQUAiK6bEAIFICAiF6AkiWiEBDRZQNCoAAERPQClCwRhYCILhsQAgUgIKIXoGSJKAREdNmAECgAARG9ACVLRCEgossGhEABCIjoBShZIgoBEV02IAQKQEBE/5+UvGPHjmr79u3V2rVrq+XLl0928fPnz+rz58/VixcvqpcvXzbu7vjx49WWLVs6S/D+/fvq2rVr2fnsZ+fOnfWeli1bVs/79etX9fXr13ovT58+7fysWSaCx549e2rZVq9eXS0sLEy9l6Ui0yx4DPFbEX0IFHussWbNmurQoUPVxo0bG3/1+/fv6t27d9Xt27cryJ8aZ8+erdatW9f56TmiQyz2tHXr1gmpUouyn7t371bfvn3r/My+E8Hl4MGDtbNpGm17WUoy9cVgjPki+hioZtbE+I4dO1Zt2rRpMuPHjx/Vx48fK/69cuXKmrgrVqyY/D0GfevWrT/Ivn79+nqtVatWTaIdzqFpfPjwobpx48YfU44cOVJt27ZtQvLv37/Xe2KwH3sG/81+rl+/PgpqOEFk8iQnm/j06VO9N2QGIxs5bPj7pSLTKEBNsaiIPgVo0/7kwIED1a5du2qjhZSkww8ePFhEYkhFRNu8efNk3pMnT6pHjx4teizEJArjPCDmnTt3ahL2HazD83Au7On169fVvXv3JntiffZNCsy+SeUfP35csaehB/JQ0thznj17Vj18+HDymBilc3tZSjINjdG064no0yLX83cY6enTpyfRqqleZu6pU6cmaTkR7fLly4ueuHfv3op/IMWXL1+qK1euZFP8pq2eOHGidioMi/ipUsHPI9rzvCFHxOft27fJ7CNik8Jxqcg0JD6zriWiz4pgx99T/xKxiJxEIiIVESs3fPSnJqZWh4g2Dh8+XEc/RluTLfcM6uGjR4/W6XBbpPYZBI6AqP/q1auO0rdP83shs0hlMbYKONI0ZEQnt5Rkapf6780YlOikd6SBeF0UcPHixdoYUQr1l3VyrS4lBbRakLqVCEVNaPMwKIzbz8tBQ0qMMdpzrFOL0ZDaktbSNWZffpw8eXJSM2PszIlpMvNjfc3eSLvpjncZ7A/5kI3ftqXa4AaWzGf/EB1C2yDiW0OPPdAk6zvobNue2tJ/5D9z5kyNL+P58+c12WNd3YRLnIsDAwfk6kP0ffv21V15dByd4BAypZwpGKPv/fv316cB1ivAvugj4PRw3DEbYq+7d++e2HRTj4O1sRN0bqXdNHpN2cGoRCflbOrkoiSMBXIDhj9m8pu1eaRzcXTt0vI7HAyR1JOT39O4sYYTSoNU5oDseVEJrMHexxremCPRPenaInHT/nxWYI65ab53Lt5gcUpkIKY/9M4xXjR63yCL+47NRXMkqf3QsMOuGBxFXrp0aTJtKJlY0K9FPwU7bToNwGZwXG3BJNXjoHwiUzE7zGE4rb2NRnTrAON1LYKjXMDibNQGiuK/8WI2DwNhnkUP5hLZr169ukjOGCHMu7Imz0p1sSEynWevjOh1aUjR6baBElC6efGmWnZaRcTfUc9v2LBhYszIbsQh+4E07MecF3+G07KOfVukYWF/Dt8l/feGH/sG/J017Hg20Y0IaIOsDmdpziBizDzKCLIyRs65+0Yb86JDGFomK4/A2bD1pxLxJADbw3a8faWCibdBMGHflqHxLCL5mzdvhjKnYf//6D51Z4e5Lq4XyuYRIYiQ/ozWRwCEx1v6qO5rNUhAyh3r3q6dWt/AYS0iP0YUlYCSUUIquxhKK5EU0Zh9Wo9DA+dcNmRR7/79+4tSf/7cR2iM6ubNm40iNEXL2CTzOEWHnCIDD46EQOfo0y4OkdZiY0a41DpDyuTlbbJnfyqBLlLZni8pWItUn8yRgQMko7XTGMpHf9owhF2NFtHZXC79QGEIZ7V4KsryeyIpZLcGlk95MB4chkV9D1wEJqaFqZqWOUQUyzbMiDAsUwKkikc+QyjBr9FUx9o836izP4MU4A3BUpkMEQZH6UuSc+fOTVLRLnV+rI2JXH69GG0tvfeR2jvRFHbogd4EGZ31WeI8yEQGgmOPJdaQMkWiN53b+0AB1jjNmMLHYELGg758ttj0jFlsbTSip9I326hPPfmznJH5WjR2YvH+GDzE4O+IWE1XRv0tstzzvNe1ZgjOxlL2MS+LgEMkea456GtU9kl2gfw+G0rdDIv7P3/+/MRR9iV6qkGIDPEsHJ3gANhPlwYTRKdBiH4tEEQDx1kgM1Ev3tIbUiZPdBwpGSclR2r4U4ncqUoMJpSAYGIpu29OzkLq1G9HIzrCYnyprnSfDqspru3IpQ2Yrl1q73X9mrkmXdtzu/49JCd7wRgsTSRLIQrHYaUPRIC8qdtu9psYRfyx2JCksOfFFN7vva3BZCcTvs9AVCS7IrrTCPN339EJNubLqCFlaupJRJ3EU4kuwcSvMUtTtYuNjUZ0vG4uyv4NovMMSENDCwMhKlsq2BS9otcFxC7n3l3Azs3hmRiVdXRxajmS932OP7/nt77eHzLN9fuKKTx/19Zgig1PCI79xNt+9CcoISzLinX6kDJ5oqeah1EXuVOJOC8VTLqs31f3fv5oRG86lx2a6JxrUkvbPfFcymeCt6Wp/tYZvxkzZWfv1KR2rNIlve2rcB/lvCxDNq7inmJ924a5r+PbGp6+WQleOC+cAmNImbwMbfuPz246xSD4IK/pfMyU3fQyKtHjJQ976FBEJ92FJKzX1LjBcBgGbJPSSMHwuHa0NWZEpyfAP9YxH6vZ543fG+CQR1Ge6OgFDP0xalNEj2lvl+gWr7na0euQMo1F9FQztYvMfR38X4voYxI99SaYvTtN7UbqR7PD6reuNXpKCQCWOxmYFnx/AYc1KHW49jnGyyL+TN4T3RtyvHiSkqtrauqbhX6d3P2DPo7f1ovXYLmFyRhSplmInjuuJINjXf+G4pjBZO4jeuyQx7euoqF2adJEJaAsfyEi96JFX7JjpJQaVmKQcXDU0vXuOJmJZRyQp+n98Bhd6YJbgy9eF805ZuTLXYGNsvujU7tHQf1tXffUGfM0RPcO2d/qG1KmPu8TdMEnZovsm0zHdDlmw3duU3eforVFW29IGGYqdY/dYlsTw/WvTs76imaM5CibTri/x97kODyRunRqqWchBU4lzu/zAoi/DJV7qSV1fMSJAPWovSGHYVNPR6fmm2hd0lifuvtbekPK5ImOM433Brye4ks/qUZ0PHrkeBA87DVh1hsqmEQbmlui+zSy7TXN+BGCFNGjEozQ8Wx7Fq8bb7yRLnPLLl76aCJ6vPyDg+ByRurV0ui8Uhc5ImFSd9TZj3/5J3dM5tfyhI433lK/9824tg59zLzizcGhZPJEz914s2zHf1AkJV88ifCE9teHuzjvvhkk8+eW6F4JuSYWKS5HMf7rKQgdu+i5G10GaHxpYxqvG0nX9KJOmyI9KVLXjPk9DgqMLC3MXb7xsqU+X8W+u3x4InXZyL955d8nSJEmkheHSjkT73szj/1Yoy/VsR5KpnhygDPlZqR/uzF1xTq+AZnSvb21Z7ryX9aZJZjkbGduiR7JGV9owRD8hxcxdKuJfUOqKwE9uabxuvGuM/tlnS6Deb6GT31yyX+SCgfHUaN189vO5WPGw1p2a4sMou1TUrnrw/4KaOrFjZjCx7LG6xSc4oWZpuu0s8oUG3teT/7zVjjS+Omv+Kmtti/nsHbM9qYJJk22NLdER6j41llKUItSpMl2Z92n+l4JzM29UBCbWn29ri81upDbz0ldPrI74XaTLrcmToJ6OH6yys+HhEQvomXumNIyodTHIXMvBMU9xaidSnHjkWNOLhqYlFek7akxq0yR6JRXENofGfrnYjtkH+Djy6gYkJpKLX9aMU0w+WeJjmD2wQofvQEdsDEkiEuqHr/wYobvGyFtr5/GqNzH6/qu/xBE92VF/Gx0Sv4uz5zm08gRk7ZGWnSsqS48ThWnjG79jUbkso+IQPIuX6OdRibDKnbdSbfJOtiXRXH7PDd2FsuMmC229R5iZtQ3mPw1oncxJs0RAvOCQJ/jtaUu06Cp+1IXVvsTAn0QENH7oKW5QmBOERDR51Rx2rYQ6IOAiN4HLc0VAnOKgIg+p4rTtoVAHwRE9D5oaa4QmFMERPQ5VZy2LQRKRUDHa6VqXnIXhYCIXpS6JWypCIjopWpecheFgIhelLolbKkIiOilal5yF4WAiF6UuiVsqQiI6KVqXnIXhYCIXpS6JWypCIjopWpecheFgIhelLolbKkIiOilal5yF4WAiF6UuiVsqQiI6KVqXnIXhYCIXpS6JWypCIjopWpecheFgIhelLolbKkIiOilal5yF4WAiF6UuiVsqQiI6KVqXnIXhYCIXpS6JWypCIjopWpecheFgIhelLolbKkIiOilal5yF4XAf7yechP7ZUOPAAAAAElFTkSuQmCC" class="h-full w-auto" alt="Site Logo">
                    @endif
                </a>
            </div>
            <div
                class="flex items-center space-x-2 text-[12px] text-[#b30000] font-normal flex-1 w-full md:w-auto justify-center md:justify-end">
                {{-- <span class="hidden sm:inline">ই-পেপার</span> --}}
                @if (!empty($facebook_url))
                    <a href="{{ $facebook_url }}" aria-label="Facebook" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-facebook-f" style="color: #1877F3;"></i>
                    </a>
                @endif
                @if (!empty($twitter_url))
                    <a href="{{ $twitter_url }}" aria-label="Twitter" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-twitter" style="color: #1DA1F2;"></i>
                    </a>
                @endif
                @if (!empty($instagram_url))
                    <a href="{{ $instagram_url }}" aria-label="Instagram" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-instagram" style="color: #E4405F;"></i>
                    </a>
                @endif
                @if (!empty($youtube_url))
                    <a href="{{ $youtube_url }}" aria-label="YouTube" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-youtube" style="color: #FF0000;"></i>
                    </a>
                @endif
                @if (!empty($google_news_url))
                    <a href="{{ $google_news_url }}" aria-label="Google News" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-google" style="color: #4285F4;"></i>
                    </a>
                @endif
                @if (!empty($linkedin_url))
                    <a href="{{ $linkedin_url }}" aria-label="LinkedIn" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-linkedin-in" style="color: #0A66C2;"></i>
                    </a>
                @endif
                @if (!empty($reddit_url))
                    <a href="{{ $reddit_url }}" aria-label="Reddit" target="_blank" rel="noopener" class="hover:opacity-80">
                        <i class="fab fa-reddit-alien" style="color: #FF4500;"></i>
                    </a>
                @endif

                <button x-data
                        @click="$store.theme.toggle()"
                        :aria-label="$store.theme.dark ? 'Switch to light mode' : 'Switch to dark mode'"
                        class="ml-2 p-2 rounded-full border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 hover:bg-gray-100 dark:hover:bg-zinc-700 transition" >
                        <svg x-show="$store.theme.dark" class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2" fill="currentColor"/>
                        </svg>
                        <svg x-show="!$store.theme.dark" class="h-5 w-5 text-gray-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke="currentColor" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" fill="currentColor"/>
                        </svg>
                </button>
        </div>
        </div>
    </header>
</section>