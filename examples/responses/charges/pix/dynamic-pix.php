<?php

$response = [
    "object" => "payment",
    "id" => "pay_382nnrhnpqwidmpr",
    "dateCreated" => "2023-12-27",
    "customer" => "cus_000005824295",
    "paymentLink" => null,
    "value" => 19.25,
    "netValue" => 18.26,
    "originalValue" => null,
    "interestValue" => null,
    "description" => null,
    "billingType" => "PIX",
    "pixTransaction" => null,
    "status" => "PENDING",
    "dueDate" => "2023-12-27",
    "originalDueDate" => "2023-12-27",
    "paymentDate" => null,
    "clientPaymentDate" => null,
    "installmentNumber" => null,
    "invoiceUrl" => "https://sandbox.asaas.com/i/382nnrhnpqwidmpr",
    "invoiceNumber" => "04828250",
    "externalReference" => null,
    "deleted" => false,
    "anticipated" => false,
    "anticipable" => false,
    "creditDate" => null,
    "estimatedCreditDate" => null,
    "transactionReceiptUrl" => null,
    "nossoNumero" => null,
    "bankSlipUrl" => null,
    "lastInvoiceViewedDate" => null,
    "lastBankSlipViewedDate" => null,
    "discount" => [
        "value" => 0.0,
        "limitDate" => null,
        "dueDateLimitDays" => 0,
        "type" => "FIXED",
    ],
    "fine" => [
        "value" => 0.0,
        "type" => "FIXED",
    ],
    "interest" => [
        "value" => 0.0,
        "type" => "PERCENTAGE",
    ],
    "postalService" => false,
    "custody" => null,
    "refunds" => null,
];

// $resource->getPixPaymentData($response):
$responsePixPaymentData = [
    "encoded_image" => "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7+p2xdhtDdbWLRKjcKsFvmJTOg/O3B5tLTvd6EY3utGNbnSjG93oRje60Y1udKMb3ehGt5t1i83o3HmeO95b3dbWYfjliHYe4K07Zm4YYtdV7AaiG93oRje60Y1udKMb3ehGN7rRjW50oxvd6Nat243169yuxI53DMpYk9tZ3ZYwevCZt+6YWKNKN7rRjW50oxvd6EY3utGNbnSjG93oRje60a1btyvORqxwnOvFYm+1tQtze1TyVFst/9YPx96KbnSjG93oRje60Y1udKMb3ehGN7rRjW50o9vNusUonGuR5g5/bDWuoD/Wx81BuVWh3tjz0o1udKMb3ehGN7rRjW50oxvd6EY3utGNbnSj28+DNTfQcxTG/Ip1lyWXWcyvzt+dK2fnOvGSv2zoRje60Y1udKMb3ehGN7rRjW50oxvd6EY3ut2sW+c0/E0l1gLH4Ih107Ged2t/t/5DoKXKTB1JutGNbnSjG93oRje60Y1udKMb3ehGN7rRjW7dus19w1jBWjIrWyLH/JozaKtA3+ouYxfDjdNON7rRjW50oxvd6EY3utGNbnSjG93oRje60e0q3eZWJ3bMSmZl7oPmLOg8z7Fid+4+jl0MB6v5tf9boBvd6EY3utGNbnSjG93oRje60Y1udKMb3ehWrdvcchx8562SNDY6sSM6twudzWYnZyWV8ZbIdKMb3ehGN7rRjW50oxvd6EY3utGNbnSjG90+o9vcuB+cla0qM9ZNX3E2Opvc2ENuzfPWVUc3utGNbnSjG93oRje60Y1udKMb3ehGN7rR7au6zZHUeVSuKFhjO9h5TW7VoAcntvMh51pvutGNbnSjG93oRje60Y1udKMb3ehGN7rRjW6f0W1udbaqzNgWzj1kTIrYfG/1j3MX8MFRKVnntWuSbnSjG93oRje60Y1udKMb3ehGN7rRjW50o1u1brFacGuCt7razpWcW41YDbplfUkr2lnc041udKMb3ehGN7rRjW50oxvd6EY3utGNbnT7jG5b37+kNnpggmNF59Y6z90xJU819422GlW60Y1udKMb3ehGN7rRjW50oxvd6EY3utGNbu/qFqvJtmblaz1vrAbtPM+xyyx2T9x4i9CNbnSjG93oRje60Y1udKMb3ehGN7rRjW50e1e3ks50Tqi57ztXsM51pnO959YXnKOh84q94gaiG93oRje60Y1udKMb3ehGN7rRjW50oxvd6KYzXa0j52Z0q7ybW5wrkI2l5CtcsZIth45udKMb3ehGN7rRjW50oxvd6EY3utGNbnSj202d6dxpj/U1JWP3N5WtojPW1G8VnQ/cEyUjSje60Y1udKMb3ehGN7rRjW50oxvd6EY3utHtId22trBkkzrrqthqlGBX8o223Dzo19zN9+B/hNCNbnSjG93oRje60Y1udKMb3ehGN7rRjW50Oz9Jg98hNQ2xx7jxmefa55IrNnY/3YhOZ71ON7rRjW50oxvd6EY3utGNbnSjG93oRje60a1bt7naaKthjJ2rufn+5fv+6ciWyJ2Mzv3w3P209ncP3ehGN7rRjW50oxvd6EY3utGNbnSjG93oRrdq3Q5+/5iMB7dhqxSODWUnZ7HDP3d5dwLdaT3d6EY3utGNbnSjG93oRje60Y1udKMb3ehGt8/o1rk6v5y6mG5XDPRBc+eavtgzxx4ydsqusJ5udKMb3ehGN7rRjW50oxvd6EY3utGNbnSj20O6ldRVZuU63Ura9rkfPqhbbPc7OaMb3ehGN7rRjW50oxvd6EY3utGNbnSjG93o9pBu75VKsbYuBsfcyB5cyZLOtGQHY38llOwR3ehGN7rRjW50oxvd6EY3utGNbnSjG93oRreHdNvya2tXYjLG2ti51YgVjiUFa2yP/i5la9npRje60Y1udKMb3ehGN7rRjW50oxvd6EY3uj2k29yuzM13ST0X65jmbpG5u+2KjniO/q2TUqI53ehGN7rRjW50oxvd6EY3utGNbnSjG93oRrd3dYtt4dzabY17ZztZcpAOfu6cfXNPtXVwrtCcbnSjG93oRje60Y1udKMb3ehGN7rRjW50o9vNusV6sbk9K7F+zoK5h4w9c+xMxpCNYbdl/dahoxvd6EY3utGNbnSjG93oRje60Y1udKMb3ej2rm5zP3ywBr1i+0vO5MGl26r2YnB0ghVbOrrRjW50oxvd6EY3utGNbnSjG93oRje60Y1udDu9wbFSqdOv2MLOVagHD+HB2Tj4ubEdjG1KScFKN7rRjW50oxvd6EY3utGNbnSjG93oRje60e1d3Urg2KrntlrgrdN+8JjNDVLsftpa5xtVvbIzpRvd6EY3utGNbnSjG93oRje60Y1udKMb3eh2XreDq3Nwk2KH/4ovOFeEdToSq1+3vI79wREbM7rRjW50oxvd6EY3utGNbnSjG93oRje60Y1un9Htxvr1l2N243zPTeFBkWNbtvXOW83m1sGJcUY3utGNbnSjG93oRje60Y1udKMb3ehGN7rR7SrdtjqXzi2cm+DOV0usv8Lr2ENuzcZcCU43utGNbnSjG93oRje60Y1udKMb3ehGN7rR7V3dYu98UMatkxNrzWJjV3IYYv1y50NuXd5/O0I3utGNbnSjG93oRje60Y1udKMb3ehGN7rR7Wbdts7zXFtXgk6sm95q+g62hCX165Z9VywO3ehGN7rRjW50oxvd6EY3utGNbnSjG93oRje6ZXWLdaY3FspzTxXbwdgzl6DT+VQlu0A3utGNbnSjG93oRje60Y1udKMb3ehGN7rRjW6nz0bsIM0pM/eQW+9c8gUPXpNbHWJpWdnxHxF0oxvd6EY3utGNbnSjG93oRje60Y1udKMb3W7WLfbOc8esZKA7L5WSxPieG9GYI1s3EN3oRje60Y1udKMb3ehGN7rRjW50oxvd6EY3uv08WHNrd3CwDm7/lrlbM7rVmW6BVXI0Ds5V7EKiG93oRje60Y1udKMb3ehGN7rRjW50oxvd6PYZ3UREekI3EaGbiAjdREToJiJCNxERuokI3URE6CYiQjcREbqJiNBNRIRuIkI3ERG6iYjQTUSEbiIidBMRoZuI0E1EhG4iInQTEaGbiAjdREToJiLfyf8A+zF0yqeqK08AAAAASUVORK5CYII=",
    "copy_paste_link" => "00020101021226820014br.gov.bcb.pix2560pix-h.asaas.com/qr/cobv/3b09f980-0078-4349-80f6-c806402f78315204000053039865802BR5925HUMBERTO ROCHA LOURES BRE6008Curitiba61088041020162070503***63047D3B",
    "expiration_date" => "2024-12-26 23:59:59",
];
