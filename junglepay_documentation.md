Introdução

# Introdução

Bem vindo a nossa documentação de API!

## Introdução

Nossa API segue os padrões REST. Sendo assim, todas as respostas serão enviadas no formato JSON.

Para autenticar com nossa API, você deve passar sua chave secreta seguindo o padrão [Basic Access Authentication](https://en.wikipedia.org/wiki/Basic_access_authentication).

Você pode encontrar suas chaves acessando o menu [Configurações -> Credenciais de API](https://app.junglepagamentos.com/settings/credentials).

Após encontrar suas chaves, você deve passar a chave secreta nos headers da requisição no campo **authorization**, seguindo o padrão abaixo:

```typescript Node.js
const options = {
    method: "POST",
    url: "https://api.junglepagamentos.com/v1/transactions",
    headers: {
        authorization: 'Basic ' + new Buffer("{SECRET_KEY}:x").toString('base64')
    }
}
```

Objeto transaction

# Objeto transaction

Ao criar uma transação, este é o objeto que você recebe como resposta. Você também receberá esse objeto quando ocorrer uma atualização de status da transação no seu postbackUrl.

[block:parameters]
{
  "data": {
    "h-0": "Propriedade",
    "h-1": "Descrição",
    "0-0": "**id**\n```int```",
    "0-1": "ID da transação.",
    "1-0": "**status**\n```string```",
    "1-1": "Status da transação.\nValores possíveis: ```processing```, ```authorized```, ```paid```, ```refunded```, ```waiting_payment```, ```refused```, ```chargedback```, ```canceled```, ```in_protest```, ```partially_paid```",
    "2-0": "**amount**\n```string```",
    "2-1": "Valor da transação em centavos.\n**Exemplo:** R$ 5,00 = 500",
    "6-0": "**paymentMethod**\n```string```",
    "6-1": "Meio de pagamento utilizado na transação.\nValores possíveis: ```credit_card```, ```pix```, ```boleto```",
    "7-0": "**installments**\n```int```",
    "7-1": "Quantidade de parcelas da transação.",
    "8-0": "**acquirerType**\n```string```",
    "8-1": "Adquirente responsável pelo processamento da transação.",
    "10-0": "**customer**\n```object```",
    "10-1": "Dados do cliente. Consulte o objeto [customer](/reference/objeto-customer)",
    "11-0": "**shipping**\n```object```",
    "11-1": "Dados referente ao endereço de entrega. Consulte o objeto [shipping](/reference/objeto-shipping)",
    "12-0": "**card**\n```object```",
    "12-1": "Dados do cartão de crédito. Consulte o objeto [card](/reference/objeto-card)",
    "13-0": "**pix**\n```object```",
    "13-1": "Dados do PIX. Consulte o objeto [pix](/reference/objeto-pix)",
    "14-0": "**boleto**\n```object```",
    "14-1": "Dados do boleto bancário. Consulte o objeto [boleto](/reference/objeto-boleto)",
    "15-0": "**sendEmail**\n```boolean```",
    "15-1": "Se será enviado um e-mail pela plataforma.",
    "16-0": "**companyId**\n```int```",
    "9-0": "**externalId**\n```string```",
    "9-1": "ID da transação na adquirente.",
    "16-1": "ID da empresa que criou a transação.",
    "17-0": "**subscriptionId**\n```int```",
    "17-1": "Quando uma transação for criada a partir de uma assinatura da plataforma, esse campo estará preenchido com o ID dessa assinatura.",
    "18-0": "**billingId**\n```int```",
    "18-1": "Quando uma transação for criada a partir de uma cobrança interna do painel de cobrança da plataforma, esse campo estará preenchido com o ID dessa cobrança.",
    "19-0": "**postbackUrl**\n```string```",
    "19-1": "URL de postback que receberá as atualizações de status da transação.",
    "20-0": "**metadata**\n```object```",
    "20-1": "Objeto com dados adicionais informados na criação da transação.",
    "21-0": "**traceable**\n```boolean```",
    "21-1": "Se o status de entrega do pedido será gerenciado pela plataforma.",
    "22-0": "**secureId**\n```string```",
    "22-1": "ID seguro da transação, para visualizá-la no próprio checkout da plataforma sem precisar de autenticação.",
    "23-0": "**secureUrl**\n```string```",
    "23-1": "URL pós compra, para acessar os detalhes da transação sem autenticação.",
    "24-0": "**createdAt**\n```datetime```",
    "24-1": "Data de criação da transação.",
    "25-0": "**updatedAt**\n```datetime```",
    "25-1": "Data da última atualização da transação.",
    "26-0": "**ip**\n```string```",
    "26-1": "IP de origem que criou a transação, podendo ser diretamente de seu cliente, caso a requisição venha diretamente do client-side, ou de seus servidores, caso tudo esteja centralizando em sua aplicação no server-side.",
    "27-0": "**refusedReason**\n```object```",
    "27-1": "Quando uma transação no cartão de crédito for recusada, esse campo estará preenchido com o motivo da recusa. Consulte o objeto [refusedReason](/reference/objeto-refusedreason)",
    "28-0": "**items**\n```array```",
    "28-1": "Dados sobre os produtos comprados. Consulte o objeto [item](/reference/objeto-item)",
    "29-0": "**refunds**\n```array```",
    "29-1": "Caso seja realizado um estorno de uma transação, esse estorno estará contido nesse array. Consulte o objeto [refund](/reference/objeto-refund)",
    "30-0": "**delivery**\n```object```",
    "30-1": "Caso a propriedade ```traceable``` seja ```true```, esse objeto estará preenchido com o status da entrega e código de rastreio. Consulte o objeto [delivery](/reference/objeto-delivery)",
    "31-0": "**fee**\n```object```",
    "31-1": "Dados sobre as taxas cobradas na transação. Consulte o objeto [fee](/reference/objeto-fee)",
    "32-0": "**splits**\n```object```",
    "32-1": "Regras de divisão da transação. Consulte o objeto [splits](/reference/objeto-splits)",
    "3-0": "**authorizedAmount**\n```int```",
    "3-1": "Valor autorizado em centavos.",
    "4-0": "**paidAmount**\n```int```",
    "4-1": "Valor pago em centavos.",
    "5-0": "**refundedAmount**\n```int```",
    "5-1": "Valor estornado em centavos."
  },
  "cols": 2,
  "rows": 33
}
[/block]

Objeto pix

# Objeto pix

Ao criar uma transação no PIX, a propriedade `pix` estará preenchida no formato abaixo:

[block:parameters]
{
  "data": {
    "h-0": "Propriedade",
    "h-1": "Descrição",
    "0-0": "**qrcode**\n```string```",
    "0-1": "QR code do PIX.",
    "1-0": "**url**\n```string```",
    "1-1": "URL do PIX.",
    "2-0": "**expirationDate**\n```date```",
    "2-1": "Data de expiração do PIX, no formato ```AAAA-MM-DD```",
    "3-0": "**createdAt**\n```date```",
    "3-1": "Data de criação."
  },
  "cols": 2,
  "rows": 4
}
[/block]

Objeto boleto

# Objeto boleto

Ao criar uma transação no boleto bancário, a propriedade `boleto` estará preenchida no formato abaixo:

[block:parameters]
{
  "data": {
    "h-0": "Propriedade",
    "h-1": "Descrição",
    "0-0": "**url**\n```string```",
    "0-1": "URL para acessar o boleto.",
    "1-0": "**barcode**\n```string```",
    "1-1": "Código de barras do boleto.",
    "2-0": "**digitableLine**\n```string```",
    "2-1": "Linha digitável.",
    "3-0": "**expirationDate**\n```date```",
    "3-1": "Data de expiração do boleto, no formato ```AAAA-MM-DD```",
    "4-0": "**instructions**\n```string```",
    "4-1": "Instruções do boleto.",
    "5-0": "**createdAt**\n```datetime```",
    "5-1": "Data de criação."
  },
  "cols": 2,
  "rows": 6
}
[/block]

Objeto refusedReason

# Objeto refusedReason

Ao criar uma transação, caso o status da transação seja `refused`, a propriedade `refusedReason` da transação vira preenchida no formato  abaixo:

[block:parameters]
{
  "data": {
    "h-0": "Propriedade",
    "h-1": "Descrição",
    "0-0": "**acquirerCode**\n```string```",
    "0-1": "Código de recusa na adquirente.",
    "1-0": "**description**\n```string```",
    "1-1": "Descrição da recusa da adquirente.",
    "2-0": "**createdAt**\n```datetime```",
    "2-1": "Data de criação."
  },
  "cols": 2,
  "rows": 3
}
[/block]

Criar transação

# Criar transação

Para criar uma transação, use a rota /transactions, tanto para cartão de crédito, boleto ou PIX.

# OpenAPI definition

````json
{
  "openapi": "3.1.0",
  "info": {
    "title": "API V1",
    "version": "1.0"
  },
  "servers": [
    {
      "url": "https://api.junglepagamentos.com/v1"
    }
  ],
  "components": {
    "securitySchemes": {
      "sec0": {
        "type": "http",
        "scheme": "basic"
      }
    }
  },
  "security": [
    {
      "sec0": []
    }
  ],
  "paths": {
    "/transactions": {
      "post": {
        "summary": "Criar transação",
        "description": "Para criar uma transação, use a rota /transactions, tanto para cartão de crédito, boleto ou PIX.",
        "operationId": "criar-transacao",
        "requestBody": {
          "content": {
            "application/json": {
              "schema": {
                "type": "object",
                "required": [
                  "amount",
                  "paymentMethod",
                  "customer",
                  "items"
                ],
                "properties": {
                  "amount": {
                    "type": "integer",
                    "description": "Valor em centavos (500 = R$ 5,00)",
                    "format": "int32"
                  },
                  "paymentMethod": {
                    "type": "string",
                    "description": "Meio de pagamento. Valores possíveis: **credit_card**, **boleto**, **pix**."
                  },
                  "card": {
                    "type": "object",
                    "description": "Informações do cartão do cliente. **Obrigatório** caso **paymentMethod** seja **credit_card**.",
                    "required": [
                      "id",
                      "hash",
                      "number",
                      "holderName",
                      "expirationMonth",
                      "expirationYear"
                    ],
                    "properties": {
                      "id": {
                        "type": "integer",
                        "description": "ID do cartão. Obs: Caso seja passado o ID, os outros campos do objeto card são dispensáveis.",
                        "format": "int32"
                      },
                      "hash": {
                        "type": "string",
                        "description": "Hash do cartão. Obs: A hash é válida por apenas 5 minutos. Não a armazene em seu banco de dados. Caso seja passado a hash, os outros campos do objeto card são dispensáveis."
                      },
                      "number": {
                        "type": "string",
                        "description": "Número do cartão."
                      },
                      "holderName": {
                        "type": "string",
                        "description": "Nome do portador do cartão."
                      },
                      "expirationMonth": {
                        "type": "integer",
                        "description": "Mês de expiração.",
                        "format": "int32"
                      },
                      "expirationYear": {
                        "type": "integer",
                        "description": "Ano de expiração.",
                        "format": "int32"
                      },
                      "cvv": {
                        "type": "string",
                        "description": "CVV do cartão."
                      }
                    }
                  },
                  "installments": {
                    "type": "integer",
                    "description": "Quantidade de parcelas. **Obrigatório** caso **paymentMethod** seja **credit_card**.",
                    "format": "int32"
                  },
                  "customer": {
                    "type": "object",
                    "description": "Dados do cliente.",
                    "required": [
                      "name",
                      "email"
                    ],
                    "properties": {
                      "id": {
                        "type": "string",
                        "description": "ID do cliente previamente criado. Não é necessário informar os outros campos caso o ID esteja preenchido."
                      },
                      "name": {
                        "type": "string",
                        "description": "Nome do cliente."
                      },
                      "email": {
                        "type": "string",
                        "description": "E-mail do cliente."
                      },
                      "document": {
                        "type": "object",
                        "description": "Documento do cliente.",
                        "required": [
                          "number",
                          "type"
                        ],
                        "properties": {
                          "number": {
                            "type": "string",
                            "description": "Número do documento."
                          },
                          "type": {
                            "type": "string",
                            "description": "Tipo do documento. Valores possíveis: cpf, cnpj"
                          }
                        }
                      },
                      "phone": {
                        "type": "string",
                        "description": "Telefone do cliente. Deve ser passado no formato 1199999999."
                      },
                      "externalRef": {
                        "type": "string",
                        "description": "Referência do cliente em sua API."
                      }
                    }
                  },
                  "shipping": {
                    "type": "object",
                    "description": "Dados de entrega.",
                    "required": [
                      "fee"
                    ],
                    "properties": {
                      "fee": {
                        "type": "integer",
                        "description": "Taxa de entrega. **Não é cobrada a mais no valor total da transação.**",
                        "format": "int32"
                      },
                      "address": {
                        "type": "object",
                        "description": "Endereço de entrega.",
                        "required": [
                          "street",
                          "streetNumber",
                          "zipCode",
                          "neighborhood",
                          "city",
                          "state",
                          "country"
                        ],
                        "properties": {
                          "street": {
                            "type": "string",
                            "description": "Rua"
                          },
                          "streetNumber": {
                            "type": "string",
                            "description": "Número"
                          },
                          "complement": {
                            "type": "string",
                            "description": "Complemento"
                          },
                          "zipCode": {
                            "type": "string",
                            "description": "CEP"
                          },
                          "neighborhood": {
                            "type": "string",
                            "description": "Bairro"
                          },
                          "city": {
                            "type": "string",
                            "description": "Cidade"
                          },
                          "state": {
                            "type": "string",
                            "description": "Estado (2 dígitos em letra maiúscula, exemplo: **SP**)"
                          },
                          "country": {
                            "type": "string",
                            "description": "País (2 dígitos, exemplo: **br**)"
                          }
                        }
                      }
                    }
                  },
                  "items": {
                    "type": "array",
                    "description": "Lista de itens da transação.",
                    "items": {
                      "properties": {
                        "title": {
                          "type": "string",
                          "description": "Título do item."
                        },
                        "unitPrice": {
                          "type": "integer",
                          "description": "Preço unitário em centavos. Ex: R$ 5,00 = 500.",
                          "format": "int32"
                        },
                        "quantity": {
                          "type": "integer",
                          "description": "Quantidade do item na transação.",
                          "format": "int32"
                        },
                        "tangible": {
                          "type": "boolean",
                          "description": "Se o item é físico."
                        },
                        "externalRef": {
                          "type": "string",
                          "description": "Referência do item em sua API."
                        }
                      },
                      "required": [
                        "title",
                        "unitPrice",
                        "quantity",
                        "tangible"
                      ],
                      "type": "object"
                    }
                  },
                  "boleto": {
                    "type": "object",
                    "description": "Informações sobre a expiração do boleto.",
                    "properties": {
                      "expiresInDays": {
                        "type": "integer",
                        "description": "Tempo de expiração do boleto em dias.",
                        "format": "int32"
                      }
                    }
                  },
                  "pix": {
                    "type": "object",
                    "description": "Informações sobre a expiração do PIX.",
                    "properties": {
                      "expiresInDays": {
                        "type": "integer",
                        "description": "Tempo de expiração do PIX em dias.",
                        "format": "int32"
                      }
                    }
                  },
                  "postbackUrl": {
                    "type": "string",
                    "description": "URL em sua API que receberá atualizações da transação."
                  },
                  "metadata": {
                    "type": "string",
                    "description": "Metadados para facilitar a visualização e controle das transações."
                  },
                  "traceable": {
                    "type": "boolean",
                    "description": "Se o status de entrega será gerenciado pelo painel. O padrão é **false**"
                  },
                  "ip": {
                    "type": "string",
                    "description": "IP do cliente."
                  },
                  "splits": {
                    "type": "array",
                    "description": "Regras de divisão da transação.",
                    "items": {
                      "properties": {
                        "recipientId": {
                          "type": "integer",
                          "description": "ID do recebedor.",
                          "format": "int32"
                        },
                        "amount": {
                          "type": "integer",
                          "description": "Valor da transação em centavos.",
                          "format": "int32"
                        },
                        "chargeProcessingFee": {
                          "type": "boolean",
                          "description": "Se o recebedor será cobrado das taxas da criação da transação. Default ```true``` para todos os recebedores da transação."
                        }
                      },
                      "required": [
                        "recipientId",
                        "amount"
                      ],
                      "type": "object"
                    }
                  }
                }
              }
            }
          }
        },
        "responses": {
          "200": {
            "description": "200",
            "content": {
              "application/json": {
                "examples": {
                  "Result": {
                    "value": "{\n\t\"id\": 282,\n\t\"amount\": 10000,\n\t\"refundedAmount\": 0,\n\t\"companyId\": 2,\n\t\"installments\": 12,\n\t\"paymentMethod\": \"credit_card\",\n\t\"status\": \"paid\",\n\t\"postbackUrl\": null,\n\t\"metadata\": null,\n\t\"traceable\": false,\n\t\"secureId\": \"a4594817-be48-4a23-81aa-4bb01f95fe78\",\n\t\"secureUrl\": \"https://link.compra.com.br/pagar/a4594817-be48-4a23-81aa-4bb01f95fe78\",\n\t\"createdAt\": \"2022-07-18T09:54:22.000Z\",\n\t\"updatedAt\": \"2022-07-18T09:54:22.000Z\",\n\t\"paidAt\": \"2022-07-18T09:54:22.000Z\",\n\t\"ip\": null,\n\t\"externalRef\": null,\n\t\"customer\": {\n\t\t\"id\": 1,\n\t\t\"externalRef\": null,\n\t\t\"name\": \"Gabryel\",\n\t\t\"email\": \"gabryel@hotmail.com\",\n\t\t\"phone\": \"11999999999\",\n\t\t\"birthdate\": null,\n\t\t\"createdAt\": \"2022-05-26T19:17:48.000Z\",\n\t\t\"document\": {\n\t\t\t\"number\": \"12345678910\",\n\t\t\t\"type\": \"cpf\"\n\t\t},\n\t\t\"address\": {\n\t\t\t\"street\": \"Rua República Argentina\",\n\t\t\t\"streetNumber\": \"4214\",\n\t\t\t\"complement\": null,\n\t\t\t\"zipCode\": \"11065030\",\n\t\t\t\"neighborhood\": \"Pompéia\",\n\t\t\t\"city\": \"Santos\",\n\t\t\t\"state\": \"SP\",\n\t\t\t\"country\": \"BR\"\n\t\t}\n\t},\n\t\"card\": {\n\t\t\"id\": 147,\n\t\t\"brand\": \"visa\",\n\t\t\"holderName\": \"GABRYEL FERREIRA\",\n\t\t\"lastDigits\": \"1111\",\n\t\t\"expirationMonth\": 3,\n\t\t\"expirationYear\": 2028,\n\t\t\"reusable\": true,\n\t\t\"createdAt\": \"2022-07-17T18:08:11.000Z\"\n\t},\n\t\"boleto\": null,\n\t\"pix\": null,\n\t\"shipping\": null,\n\t\"refusedReason\": null,\n\t\"items\": [\n\t\t{\n\t\t\t\"externalRef\": null,\n\t\t\t\"title\": \"b456\",\n\t\t\t\"unitPrice\": 100,\n\t\t\t\"quantity\": 1,\n\t\t\t\"tangible\": false\n\t\t}\n\t],\n\t\"splits\": [\n\t\t{\n\t\t\t\"recipientId\": 1,\n\t\t\t\"amount\": 10000,\n\t\t\t\"netAmount\": 9400\n\t\t}\n\t],\n\t\"refunds\": [],\n\t\"delivery\": null,\n\t\"fee\": {\n\t\t\"fixedAmount\": 200,\n\t\t\"spreadPercentage\": 4,\n\t\t\"estimatedFee\": 600,\n\t\t\"netAmount\": 9400\n\t}\n}"
                  }
                },
                "schema": {
                  "type": "object",
                  "properties": {
                    "id": {
                      "type": "integer",
                      "example": 282,
                      "default": 0
                    },
                    "amount": {
                      "type": "integer",
                      "example": 10000,
                      "default": 0
                    },
                    "refundedAmount": {
                      "type": "integer",
                      "example": 0,
                      "default": 0
                    },
                    "companyId": {
                      "type": "integer",
                      "example": 2,
                      "default": 0
                    },
                    "installments": {
                      "type": "integer",
                      "example": 12,
                      "default": 0
                    },
                    "paymentMethod": {
                      "type": "string",
                      "example": "credit_card"
                    },
                    "status": {
                      "type": "string",
                      "example": "paid"
                    },
                    "postbackUrl": {},
                    "metadata": {},
                    "traceable": {
                      "type": "boolean",
                      "example": false,
                      "default": true
                    },
                    "secureId": {
                      "type": "string",
                      "example": "a4594817-be48-4a23-81aa-4bb01f95fe78"
                    },
                    "secureUrl": {
                      "type": "string",
                      "example": "https://link.compra.com.br/pagar/a4594817-be48-4a23-81aa-4bb01f95fe78"
                    },
                    "createdAt": {
                      "type": "string",
                      "example": "2022-07-18T09:54:22.000Z"
                    },
                    "updatedAt": {
                      "type": "string",
                      "example": "2022-07-18T09:54:22.000Z"
                    },
                    "paidAt": {
                      "type": "string",
                      "example": "2022-07-18T09:54:22.000Z"
                    },
                    "ip": {},
                    "externalRef": {},
                    "customer": {
                      "type": "object",
                      "properties": {
                        "id": {
                          "type": "integer",
                          "example": 1,
                          "default": 0
                        },
                        "externalRef": {},
                        "name": {
                          "type": "string",
                          "example": "Gabryel"
                        },
                        "email": {
                          "type": "string",
                          "example": "gabryel@hotmail.com"
                        },
                        "phone": {
                          "type": "string",
                          "example": "11999999999"
                        },
                        "birthdate": {},
                        "createdAt": {
                          "type": "string",
                          "example": "2022-05-26T19:17:48.000Z"
                        },
                        "document": {
                          "type": "object",
                          "properties": {
                            "number": {
                              "type": "string",
                              "example": "12345678910"
                            },
                            "type": {
                              "type": "string",
                              "example": "cpf"
                            }
                          }
                        },
                        "address": {
                          "type": "object",
                          "properties": {
                            "street": {
                              "type": "string",
                              "example": "Rua República Argentina"
                            },
                            "streetNumber": {
                              "type": "string",
                              "example": "4214"
                            },
                            "complement": {},
                            "zipCode": {
                              "type": "string",
                              "example": "11065030"
                            },
                            "neighborhood": {
                              "type": "string",
                              "example": "Pompéia"
                            },
                            "city": {
                              "type": "string",
                              "example": "Santos"
                            },
                            "state": {
                              "type": "string",
                              "example": "SP"
                            },
                            "country": {
                              "type": "string",
                              "example": "BR"
                            }
                          }
                        }
                      }
                    },
                    "card": {
                      "type": "object",
                      "properties": {
                        "id": {
                          "type": "integer",
                          "example": 147,
                          "default": 0
                        },
                        "brand": {
                          "type": "string",
                          "example": "visa"
                        },
                        "holderName": {
                          "type": "string",
                          "example": "GABRYEL FERREIRA"
                        },
                        "lastDigits": {
                          "type": "string",
                          "example": "1111"
                        },
                        "expirationMonth": {
                          "type": "integer",
                          "example": 3,
                          "default": 0
                        },
                        "expirationYear": {
                          "type": "integer",
                          "example": 2028,
                          "default": 0
                        },
                        "reusable": {
                          "type": "boolean",
                          "example": true,
                          "default": true
                        },
                        "createdAt": {
                          "type": "string",
                          "example": "2022-07-17T18:08:11.000Z"
                        }
                      }
                    },
                    "boleto": {},
                    "pix": {},
                    "shipping": {},
                    "refusedReason": {},
                    "items": {
                      "type": "array",
                      "items": {
                        "type": "object",
                        "properties": {
                          "externalRef": {},
                          "title": {
                            "type": "string",
                            "example": "b456"
                          },
                          "unitPrice": {
                            "type": "integer",
                            "example": 100,
                            "default": 0
                          },
                          "quantity": {
                            "type": "integer",
                            "example": 1,
                            "default": 0
                          },
                          "tangible": {
                            "type": "boolean",
                            "example": false,
                            "default": true
                          }
                        }
                      }
                    },
                    "splits": {
                      "type": "array",
                      "items": {
                        "type": "object",
                        "properties": {
                          "recipientId": {
                            "type": "integer",
                            "example": 1,
                            "default": 0
                          },
                          "amount": {
                            "type": "integer",
                            "example": 10000,
                            "default": 0
                          },
                          "netAmount": {
                            "type": "integer",
                            "example": 9400,
                            "default": 0
                          }
                        }
                      }
                    },
                    "refunds": {
                      "type": "array",
                      "items": {
                        "type": "object",
                        "properties": {}
                      }
                    },
                    "delivery": {},
                    "fee": {
                      "type": "object",
                      "properties": {
                        "fixedAmount": {
                          "type": "integer",
                          "example": 200,
                          "default": 0
                        },
                        "spreadPercentage": {
                          "type": "integer",
                          "example": 4,
                          "default": 0
                        },
                        "estimatedFee": {
                          "type": "integer",
                          "example": 600,
                          "default": 0
                        },
                        "netAmount": {
                          "type": "integer",
                          "example": 9400,
                          "default": 0
                        }
                      }
                    }
                  }
                }
              }
            }
          },
          "400": {
            "description": "400",
            "content": {
              "application/json": {
                "examples": {
                  "Result": {
                    "value": "{}"
                  }
                },
                "schema": {
                  "type": "object",
                  "properties": {}
                }
              }
            }
          }
        },
        "deprecated": false
      }
    }
  },
  "x-readme": {
    "headers": [],
    "explorer-enabled": true,
    "proxy-enabled": true
  },
  "x-readme-fauxas": true,
  "_id": "6903c3030146e106032cec07:6903c3030146e106032cec0b"
}
````