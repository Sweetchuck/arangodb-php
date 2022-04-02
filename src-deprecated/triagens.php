<?php

declare(strict_types=1);

namespace triagens\ArangoDb;

class_alias(\ArangoDBClient\AdminHandler::class, AdminHandler::class);
class_alias(\ArangoDBClient\Analyzer::class, Analyzer::class);
class_alias(\ArangoDBClient\AnalyzerHandler::class, AnalyzerHandler::class);
class_alias(\ArangoDBClient\AqlUserFunction::class, AqlUserFunction::class);
class_alias(\ArangoDBClient\Batch::class, Batch::class);
class_alias(\ArangoDBClient\BatchPart::class, BatchPart::class);
class_alias(\ArangoDBClient\BindVars::class, BindVars::class);
class_alias(\ArangoDBClient\ClientException::class, ClientException::class);
class_alias(\ArangoDBClient\Collection::class, Collection::class);
class_alias(\ArangoDBClient\CollectionHandler::class, CollectionHandler::class);
class_alias(\ArangoDBClient\ConnectException::class, ConnectException::class);
class_alias(\ArangoDBClient\Connection::class, Connection::class);
class_alias(\ArangoDBClient\ConnectionOptions::class, ConnectionOptions::class);
class_alias(\ArangoDBClient\Cursor::class, Cursor::class);
class_alias(\ArangoDBClient\Database::class, Database::class);
class_alias(\ArangoDBClient\DefaultValues::class, DefaultValues::class);
class_alias(\ArangoDBClient\Document::class, Document::class);
class_alias(\ArangoDBClient\DocumentClassable::class, DocumentClassable::class);
class_alias(\ArangoDBClient\DocumentHandler::class, DocumentHandler::class);
class_alias(\ArangoDBClient\Edge::class, Edge::class);
class_alias(\ArangoDBClient\EdgeDefinition::class, EdgeDefinition::class);
class_alias(\ArangoDBClient\EdgeHandler::class, EdgeHandler::class);
class_alias(\ArangoDBClient\Endpoint::class, Endpoint::class);
class_alias(\ArangoDBClient\Exception::class, Exception::class);
class_alias(\ArangoDBClient\FailoverException::class, FailoverException::class);
class_alias(\ArangoDBClient\FoxxHandler::class, FoxxHandler::class);
class_alias(\ArangoDBClient\Graph::class, Graph::class);
class_alias(\ArangoDBClient\GraphHandler::class, GraphHandler::class);
class_alias(\ArangoDBClient\Handler::class, Handler::class);
class_alias(\ArangoDBClient\HttpHelper::class, HttpHelper::class);
class_alias(\ArangoDBClient\HttpResponse::class, HttpResponse::class);
class_alias(\ArangoDBClient\QueryCacheHandler::class, QueryCacheHandler::class);
class_alias(\ArangoDBClient\QueryHandler::class, QueryHandler::class);
class_alias(\ArangoDBClient\ServerException::class, ServerException::class);
class_alias(\ArangoDBClient\SmartGraph::class, SmartGraph::class);
class_alias(\ArangoDBClient\Statement::class, Statement::class);
class_alias(\ArangoDBClient\StreamingTransaction::class, StreamingTransaction::class);
class_alias(\ArangoDBClient\StreamingTransactionCollection::class, StreamingTransactionCollection::class);
class_alias(\ArangoDBClient\StreamingTransactionHandler::class, StreamingTransactionHandler::class);
class_alias(\ArangoDBClient\TraceRequest::class, TraceRequest::class);
class_alias(\ArangoDBClient\TraceResponse::class, TraceResponse::class);
class_alias(\ArangoDBClient\Transaction::class, Transaction::class);
class_alias(\ArangoDBClient\TransactionBase::class, TransactionBase::class);
class_alias(\ArangoDBClient\Traversal::class, Traversal::class);
class_alias(\ArangoDBClient\UpdatePolicy::class, UpdatePolicy::class);
class_alias(\ArangoDBClient\UrlHelper::class, UrlHelper::class);
class_alias(\ArangoDBClient\Urls::class, Urls::class);
class_alias(\ArangoDBClient\User::class, User::class);
class_alias(\ArangoDBClient\UserHandler::class, UserHandler::class);
class_alias(\ArangoDBClient\ValueValidator::class, ValueValidator::class);
class_alias(\ArangoDBClient\Vertex::class, Vertex::class);
class_alias(\ArangoDBClient\VertexHandler::class, VertexHandler::class);
class_alias(\ArangoDBClient\View::class, View::class);
class_alias(\ArangoDBClient\ViewHandler::class, ViewHandler::class);

if (time() < 0) {
    /**
     * @deprecated
     */
    class AdminHandler {}

    /**
     * @deprecated
     */
    class Analyzer {}

    /**
     * @deprecated
     */
    class AnalyzerHandler {}

    /**
     * @deprecated
     */
    class AqlUserFunction {}

    /**
     * @deprecated
     */
    class Batch {}

    /**
     * @deprecated
     */
    class BatchPart {}

    /**
     * @deprecated
     */
    class BindVars {}

    /**
     * @deprecated
     */
    class ClientException {}

    /**
     * @deprecated
     */
    class Collection {}

    /**
     * @deprecated
     */
    class CollectionHandler {}

    /**
     * @deprecated
     */
    class ConnectException {}

    /**
     * @deprecated
     */
    class Connection {}

    /**
     * @deprecated
     */
    class ConnectionOptions {}

    /**
     * @deprecated
     */
    class Cursor {}

    /**
     * @deprecated
     */
    class Database {}

    /**
     * @deprecated
     */
    class DefaultValues {}

    /**
     * @deprecated
     */
    class Document {}

    /**
     * @deprecated
     */
    trait DocumentClassable {}

    /**
     * @deprecated
     */
    class DocumentHandler {}

    /**
     * @deprecated
     */
    class Edge {}

    /**
     * @deprecated
     */
    class EdgeDefinition {}

    /**
     * @deprecated
     */
    class EdgeHandler {}

    /**
     * @deprecated
     */
    class Endpoint {}

    /**
     * @deprecated
     */
    class Exception {}

    /**
     * @deprecated
     */
    class FailoverException {}

    /**
     * @deprecated
     */
    class FoxxHandler {}

    /**
     * @deprecated
     */
    class Graph {}

    /**
     * @deprecated
     */
    class GraphHandler {}

    /**
     * @deprecated
     */
    class Handler {}

    /**
     * @deprecated
     */
    class HttpHelper {}

    /**
     * @deprecated
     */
    class HttpResponse {}

    /**
     * @deprecated
     */
    class QueryCacheHandler {}

    /**
     * @deprecated
     */
    class QueryHandler {}

    /**
     * @deprecated
     */
    class ServerException {}

    /**
     * @deprecated
     */
    class SmartGraph {}

    /**
     * @deprecated
     */
    class Statement {}

    /**
     * @deprecated
     */
    class StreamingTransaction {}

    /**
     * @deprecated
     */
    class StreamingTransactionCollection {}

    /**
     * @deprecated
     */
    class StreamingTransactionHandler {}

    /**
     * @deprecated
     */
    class TraceRequest {}

    /**
     * @deprecated
     */
    class TraceResponse {}

    /**
     * @deprecated
     */
    class Transaction {}

    /**
     * @deprecated
     */
    class TransactionBase {}

    /**
     * @deprecated
     */
    class Traversal {}

    /**
     * @deprecated
     */
    class UpdatePolicy {}

    /**
     * @deprecated
     */
    class UrlHelper {}

    /**
     * @deprecated
     */
    class Urls {}

    /**
     * @deprecated
     */
    class User {}

    /**
     * @deprecated
     */
    class UserHandler {}

    /**
     * @deprecated
     */
    class ValueValidator {}

    /**
     * @deprecated
     */
    class Vertex {}

    /**
     * @deprecated
     */
    class VertexHandler {}

    /**
     * @deprecated
     */
    class View {}

    /**
     * @deprecated
     */
    class ViewHandler {}
}
