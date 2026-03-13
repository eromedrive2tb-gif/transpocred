---
name: php-modularizer
description: Refatora arquivos PHP monolíticos separando a lógica de backend, frontend e acesso a dados em arquivos distintos.
---

# Clean Architecture & Modularization Standards

Ao realizar o refactor do projeto, siga rigorosamente os princípios de separação de interesses (SoC) e responsabilidade única (SRP). O objetivo é transformar código procedural misto em uma estrutura modular sustentável.

## 1. Princípios de Camadas (Layers)

Toda lógica deve ser distribuída em camadas bem definidas, independentemente do nome do arquivo original:

- **Domain/Business Logic**: Toda validação, cálculos, regras de negócio e processamento de dados devem residir em classes puras. Esta camada não deve conhecer o HTML ou o protocolo de entrega (HTTP/Request).
- **Presentation (Views)**: Arquivos de saída devem ser puramente declarativos. Utilize apenas lógica de exibição básica (loops e condicionais simples). Nenhuma regra de negócio ou processamento complexo é permitido aqui.
- **Data Access (Persistence)**: O acesso a fontes de dados (sejam arquivos JSON, bancos de dados ou APIs) deve ser abstraído. A lógica de leitura/escrita não deve estar espalhada pelo código.
- **Infrastructure/Routing**: Os pontos de entrada devem apenas orquestrar a comunicação entre as camadas anteriores, atuando como "glue code".

## 2. Estratégia de Refatoração

Para cada componente monolítico identificado, execute o seguinte fluxo:

1. **Isolamento de Estado**: Identifique variáveis globais e dependências externas, movendo-as para injeção de dependência ou parâmetros de função.
2. **Extração de Lógica**: Remova blocos de lógica de processamento e encapsule-os em módulos/classes independentes.
3. **Desacoplamento de UI**: Garanta que a interface receba apenas dados já processados. A View nunca deve "decidir" nada, apenas "exibir".
4. **Interface de Contrato**: Módulos devem se comunicar através de interfaces claras, facilitando substituições futuras sem quebrar o sistema.

## 3. Restrições Técnicas

- **Zero Mixing**: É estritamente proibido misturar lógica de servidor (PHP) com definições de estilo ou estruturas de marcação no mesmo bloco lógico.
- **Modularidade Atômica**: Cada novo módulo criado deve focar em resolver apenas um problema do domínio.
- **Paridade Funcional**: A estrutura deve mudar, mas o comportamento externo deve permanecer idêntico ao original (Refactor vs. Redesign).